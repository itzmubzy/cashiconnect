<?php

class InvestmentModel
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function getInvestmentsByInvestor(int $investorProfileId): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT i.id, i.amount, i.status, i.invested_at, i.confirmation_code,
                    i.profit_share,
                    fp.id AS project_id, fp.title, fp.crop, fp.status AS project_status,
                    fp.required_budget, fp.current_funding, fp.duration_months,
                    u.name AS farmer_name
             FROM investments i
             JOIN farming_projects fp ON i.project_id = fp.id
             JOIN farmer_profiles fpa ON fp.farmer_id = fpa.id
             JOIN users u ON fpa.user_id = u.id
             WHERE i.investor_id = ?
             ORDER BY i.invested_at DESC"
        );
        mysqli_stmt_bind_param($stmt, "i", $investorProfileId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function getPortfolioTotals(int $investorProfileId): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT COUNT(*) AS cnt, COALESCE(SUM(amount), 0) AS total
             FROM investments WHERE investor_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $investorProfileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result) ?: ['cnt' => 0, 'total' => 0.0];
    }

    public function getOwnDistribution(int $projectId, int $investorProfileId): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT COALESCE(SUM(i.amount), 0) AS total_amount,
                    COALESCE(SUM(i.profit_share), 0) AS profit_share
             FROM investments i
             WHERE i.project_id = ? AND i.status = 'confirmed' AND i.investor_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "ii", $projectId, $investorProfileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = $result ? mysqli_fetch_assoc($result) : null;
        return [
            'own_profit_share' => $row ? (float)$row['profit_share']  : 0.0,
            'own_total_amount' => $row ? (float)$row['total_amount'] : 0.0,
        ];
    }

    public function getOtherInvestorsDistribution(int $projectId, int $excludeInvestorProfileId): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT i.investor_id, u.name AS investor_name,
                    COALESCE(SUM(i.amount), 0) AS total_amount,
                    COALESCE(SUM(i.profit_share), 0) AS profit_share
             FROM investments i
             JOIN investor_profiles ip ON i.investor_id = ip.id
             JOIN users u ON ip.user_id = u.id
             WHERE i.project_id = ? AND i.status = 'confirmed' AND i.investor_id <> ?
             GROUP BY i.investor_id, u.name
             ORDER BY profit_share DESC, total_amount DESC, u.name ASC"
        );
        mysqli_stmt_bind_param($stmt, "ii", $projectId, $excludeInvestorProfileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getLandLeaseAmount(int $landId): float
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT COALESCE(hr.lease_amount, 0) AS lease_amount
             FROM hiring_requests hr
             WHERE hr.land_id = ? AND hr.status = 'accepted'
             ORDER BY hr.requested_at DESC, hr.id DESC
             LIMIT 1"
        );
        mysqli_stmt_bind_param($stmt, "i", $landId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = $result ? mysqli_fetch_assoc($result) : null;
        return $row ? (float)$row['lease_amount'] : 0.0;
    }

    public function createInvestment(
        int $investorProfileId,
        int $projectId,
        float $amount,
        string $confirmationCode
    ): bool {
        $stmt = mysqli_prepare($this->db,
            "INSERT INTO investments (investor_id, project_id, amount, status, confirmation_code)
             VALUES (?, ?, ?, 'confirmed', ?)"
        );
        mysqli_stmt_bind_param($stmt, "iids", $investorProfileId, $projectId, $amount, $confirmationCode);
        return mysqli_stmt_execute($stmt);
    }

    public function getShareoutEligibleProjects(): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT fp.id, fp.title, fp.crop, fp.required_budget, fp.current_funding, fp.completed_at,
                    fp.status,
                    u.name AS farmer_name,
                    lu.name AS landowner_name,
                    COUNT(h.id) AS harvest_count,
                    COALESCE(SUM(h.estimated_value), 0) AS total_revenue,
                    COALESCE((SELECT SUM(i.amount) FROM investments i
                              WHERE i.project_id = fp.id AND i.status = 'confirmed'), 0) AS confirmed_investment,
                    COALESCE((SELECT COUNT(DISTINCT i.investor_id) FROM investments i
                              WHERE i.project_id = fp.id AND i.status = 'confirmed'), 0) AS investor_count,
                    COALESCE((SELECT hr.lease_amount FROM hiring_requests hr
                              WHERE hr.land_id = fp.land_id AND hr.status IN ('accepted', 'completed')
                              ORDER BY hr.requested_at DESC, hr.id DESC LIMIT 1), 0) AS lease_amount
             FROM farming_projects fp
             JOIN farmer_profiles fpa ON fp.farmer_id = fpa.id
             JOIN users u ON fpa.user_id = u.id
             JOIN lands l ON fp.land_id = l.id
             JOIN landowner_profiles lo ON l.landowner_id = lo.id
             JOIN users lu ON lo.user_id = lu.id
             LEFT JOIN harvests h ON fp.id = h.project_id
             WHERE fp.status = 'completed' AND fp.profit_distributed_at IS NULL
             GROUP BY fp.id, fp.title, fp.crop, fp.required_budget, fp.current_funding,
                      fp.completed_at, fp.status, u.name, lu.name
             ORDER BY fp.completed_at DESC, fp.id DESC"
        );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
}
