<?php

class ProjectModel
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function getApprovedProjects(string $keyword = '', string $filter = 'all'): array
    {
        $sql = "SELECT fp.id, fp.title, fp.crop, fp.description, fp.required_budget, fp.current_funding,
                       fp.duration_months, fp.status, fp.submitted_at,
                       u.name AS farmer_name, fpa.experience_years,
                       l.title AS land_title, l.area, l.area_unit, l.location
                FROM farming_projects fp
                JOIN farmer_profiles fpa ON fp.farmer_id = fpa.id
                JOIN users u ON fpa.user_id = u.id
                JOIN lands l ON fp.land_id = l.id
                WHERE fp.status IN ('approved', 'active')";

        if ($filter === 'crops') {
            $sql .= " AND (fp.crop LIKE '%rice%' OR fp.crop LIKE '%wheat%' OR fp.crop LIKE '%maize%'
                          OR fp.crop LIKE '%paddy%' OR fp.crop LIKE '%vegetable%' OR fp.crop LIKE '%soy%')";
        }

        if ($keyword !== '') {
            $like  = "%" . $keyword . "%";
            $sql  .= " AND (fp.title LIKE ? OR fp.crop LIKE ? OR l.location LIKE ? OR u.name LIKE ?)";
            $sql  .= " ORDER BY fp.submitted_at DESC";
            $stmt  = mysqli_prepare($this->db, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $like, $like, $like, $like);
        } else {
            $sql  .= " ORDER BY fp.submitted_at DESC";
            $stmt  = mysqli_prepare($this->db, $sql);
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function searchProjects(string $keyword): array
    {
        return $this->getApprovedProjects($keyword, 'all');
    }

    public function getProjectById(int $projectId): ?array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT fp.id, fp.title, fp.crop, fp.description, fp.required_budget,
                    fp.current_funding, fp.duration_months, fp.progress_percentage, fp.status, fp.land_id,
                    fp.submitted_at, fp.total_profit, fp.farmer_profit_share,
                    fp.platform_profit_share, fp.profit_distributed_at,
                    u.name AS farmer_name, fpa.specialization, fpa.experience_years, fpa.rating,
                    l.title AS land_title, l.location, l.area, l.area_unit, l.soil_type, l.land_type, l.image AS land_image
             FROM farming_projects fp
             JOIN farmer_profiles fpa ON fp.farmer_id = fpa.id
             JOIN users u ON fpa.user_id = u.id
             JOIN lands l ON fp.land_id = l.id
             WHERE fp.id = ? AND fp.status IN ('approved', 'active', 'completed')"
        );
        mysqli_stmt_bind_param($stmt, "i", $projectId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result) ?: null;
    }

    public function getProjectUpdates(int $projectId): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT milestone, description, progress_percentage, expense, update_date
             FROM project_updates
             WHERE project_id = ?
             ORDER BY update_date DESC"
        );
        mysqli_stmt_bind_param($stmt, "i", $projectId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getTotalCount(): int
    {
        $res = mysqli_query($this->db, "SELECT COUNT(*) as count FROM farming_projects");
        if ($res && $row = mysqli_fetch_assoc($res)) {
            return (int)$row['count'];
        }
        return 0;
    }

    public function getPendingProjects(): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT fp.id, fp.title, fp.crop, fp.description, fp.required_budget,
                    fp.current_funding, fp.duration_months, fp.submitted_at,
                    u.name AS farmer_name, u.email AS farmer_email,
                    l.title AS land_title, l.location, l.area, l.area_unit
             FROM farming_projects fp
             JOIN farmer_profiles fpa ON fp.farmer_id = fpa.id
             JOIN users u ON fpa.user_id = u.id
             JOIN lands l ON fp.land_id = l.id
             WHERE fp.status = 'pending'
             ORDER BY fp.submitted_at ASC"
        );
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function getAllProjectsOverview(): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT fp.id, fp.title, fp.crop, fp.required_budget, fp.current_funding, fp.status,
                    u.name AS farmer_name
             FROM farming_projects fp
             JOIN farmer_profiles fpa ON fp.farmer_id = fpa.id
             JOIN users u ON fpa.user_id = u.id
             ORDER BY fp.id ASC"
        );
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function approveProject(int $projectId): int
    {
        $stmt = mysqli_prepare($this->db,
            "UPDATE farming_projects SET status = 'approved', approved_at = NOW() WHERE id = ? AND status = 'pending'"
        );
        mysqli_stmt_bind_param($stmt, "i", $projectId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public function rejectProject(int $projectId): int
    {
        $stmt = mysqli_prepare($this->db,
            "UPDATE farming_projects SET status = 'rejected' WHERE id = ? AND status = 'pending'"
        );
        mysqli_stmt_bind_param($stmt, "i", $projectId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public function getEligibleLandsForFarmer(int $farmerProfileId): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT DISTINCT l.id, l.title, l.location, l.area, l.area_unit,
                    COALESCE(hr.lease_amount, 0) AS lease_amount
             FROM lands l
             JOIN hiring_requests hr ON hr.land_id = l.id
             WHERE hr.farmer_id = ? AND hr.status = 'accepted'
               AND l.id NOT IN (SELECT land_id FROM farming_projects WHERE status != 'rejected')
             ORDER BY l.id ASC"
        );
        mysqli_stmt_bind_param($stmt, "i", $farmerProfileId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function validateLandForFarmer(int $farmerProfileId, int $landId): ?array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT l.id, COALESCE(hr.lease_amount, 0) AS lease_amount
             FROM lands l
             JOIN hiring_requests hr ON hr.land_id = l.id
             WHERE hr.farmer_id = ? AND hr.status = 'accepted' AND l.id = ?
               AND l.id NOT IN (SELECT land_id FROM farming_projects WHERE status != 'rejected')"
        );
        mysqli_stmt_bind_param($stmt, "ii", $farmerProfileId, $landId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
    }

    public function createProject(
        int $farmerProfileId,
        int $landId,
        string $title,
        string $crop,
        string $description,
        float $requiredBudget,
        int $durationMonths
    ): bool {
        $stmt = mysqli_prepare($this->db,
            "INSERT INTO farming_projects (farmer_id, land_id, title, crop, description, required_budget, duration_months, status, submitted_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', NOW())"
        );
        mysqli_stmt_bind_param($stmt, "iisssdi",
            $farmerProfileId, $landId, $title, $crop, $description, $requiredBudget, $durationMonths
        );
        return mysqli_stmt_execute($stmt);
    }

    public function getFarmerPostableProjects(int $farmerProfileId): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT id, title, status, crop FROM farming_projects
             WHERE farmer_id = ? AND status IN ('approved', 'active', 'completed')
             ORDER BY id ASC"
        );
        mysqli_stmt_bind_param($stmt, "i", $farmerProfileId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function getFarmerHarvestableProjects(int $farmerProfileId): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT id, title, status, crop FROM farming_projects
             WHERE farmer_id = ? AND status IN ('active', 'completed')
             ORDER BY id ASC"
        );
        mysqli_stmt_bind_param($stmt, "i", $farmerProfileId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function getFarmerShareouts(int $farmerProfileId): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT id, title, crop, total_profit, farmer_profit_share, platform_profit_share, profit_distributed_at
             FROM farming_projects
             WHERE farmer_id = ? AND status = 'completed' AND profit_distributed_at IS NOT NULL
             ORDER BY profit_distributed_at DESC, id DESC"
        );
        mysqli_stmt_bind_param($stmt, "i", $farmerProfileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getProjectCountForFarmer(int $farmerProfileId): int
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT COUNT(*) as count FROM farming_projects WHERE farmer_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $farmerProfileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            return (int)$row['count'];
        }
        return 0;
    }


    public function getFarmerProjectById(int $projectId, int $farmerProfileId): ?array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT fp.id, fp.farmer_id, fp.land_id, fp.title, fp.crop, fp.description,
                    fp.required_budget, fp.current_funding, fp.duration_months,
                    fp.progress_percentage, fp.status, fp.rejection_reason,
                    fp.submitted_at, fp.approved_at, fp.completed_at,
                    fp.total_profit, fp.farmer_profit_share, fp.platform_profit_share,
                    fp.profit_distributed_at,
                    l.title AS land_title, l.location, l.area, l.area_unit,
                    l.soil_type, l.land_type, l.description AS land_description,
                    l.availability_status,
                    lo.user_id AS landowner_user_id, lu.name AS landowner_name,
                    lu.phone AS landowner_phone, lu.email AS landowner_email
             FROM farming_projects fp
             JOIN lands l ON fp.land_id = l.id
             JOIN landowner_profiles lo ON l.landowner_id = lo.id
             JOIN users lu ON lo.user_id = lu.id
             WHERE fp.id = ? AND fp.farmer_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "ii", $projectId, $farmerProfileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
    }

    public function getFarmerProjectInvestors(int $projectId): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT i.id, i.amount, i.status, i.invested_at, i.profit_share,
                    u.name AS investor_name
             FROM investments i
             JOIN investor_profiles ip ON i.investor_id = ip.id
             JOIN users u ON ip.user_id = u.id
             WHERE i.project_id = ?
             ORDER BY i.invested_at DESC, i.id DESC"
        );
        mysqli_stmt_bind_param($stmt, "i", $projectId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getFarmerProjectStats(int $projectId, float $requiredBudget): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT
                COALESCE(SUM(CASE WHEN status = 'confirmed' THEN amount END), 0) AS confirmed_amount,
                COALESCE(SUM(CASE WHEN status = 'confirmed' THEN 1 END), 0)      AS confirmed_count,
                COALESCE(SUM(CASE WHEN status = 'pending'   THEN amount END), 0) AS pending_amount
             FROM investments
             WHERE project_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $projectId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = $result ? mysqli_fetch_assoc($result) : null;

        $confirmed_amount = $row ? round((float)$row['confirmed_amount'], 2) : 0.0;
        $confirmed_count  = $row ? (int)$row['confirmed_count'] : 0;

        $harvest_stmt = mysqli_prepare($this->db,
            "SELECT COUNT(*) AS harvest_count, COALESCE(SUM(estimated_value), 0) AS total_revenue
             FROM harvests WHERE project_id = ?"
        );
        mysqli_stmt_bind_param($harvest_stmt, "i", $projectId);
        mysqli_stmt_execute($harvest_stmt);
        $h_res = mysqli_stmt_get_result($harvest_stmt);
        $h_row = $h_res ? mysqli_fetch_assoc($h_res) : null;

        $funding_pct = ($requiredBudget > 0)
            ? round(($confirmed_amount / $requiredBudget) * 100, 2)
            : 0.0;

        return [
            'confirmed_amount' => $confirmed_amount,
            'confirmed_count'  => $confirmed_count,
            'pending_amount'   => $row ? round((float)$row['pending_amount'], 2) : 0.0,
            'remaining'        => round(max(0.0, $requiredBudget - $confirmed_amount), 2),
            'funding_pct'      => min(100.0, $funding_pct),
            'harvest_count'    => $h_row ? (int)$h_row['harvest_count'] : 0,
            'harvest_revenue'  => $h_row ? round((float)$h_row['total_revenue'], 2) : 0.0,
        ];
    }

    public function getFarmerProjectsList(int $farmerProfileId): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT id, title, crop, required_budget, current_funding, status, progress_percentage
             FROM farming_projects
             WHERE farmer_id = ?
             ORDER BY id DESC"
        );
        mysqli_stmt_bind_param($stmt, "i", $farmerProfileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getLandLeaseInfo(int $landId): ?array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT hr.lease_amount, hr.lease_paid_at, hr.status AS hr_status, u.name AS farmer_name
             FROM hiring_requests hr
             JOIN farmer_profiles fpa ON hr.farmer_id = fpa.id
             JOIN users u ON fpa.user_id = u.id
             WHERE hr.land_id = ? AND hr.status IN ('accepted', 'completed')
             ORDER BY hr.requested_at DESC, hr.id DESC
             LIMIT 1"
        );
        mysqli_stmt_bind_param($stmt, "i", $landId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
    }

    public function completeFarmerProject(int $projectId, int $farmerProfileId): int
    {
        $stmt = mysqli_prepare($this->db,
            "UPDATE farming_projects
             SET status = 'completed', progress_percentage = 100, completed_at = NOW()
             WHERE id = ? AND farmer_id = ? AND status = 'active'"
        );
        mysqli_stmt_bind_param($stmt, "ii", $projectId, $farmerProfileId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }
}
