<?php

class FarmerModel
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function getProfileByUserId(int $userId): ?array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT * FROM farmer_profiles WHERE user_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
    }

    public function getProfileId(int $userId): int
    {
        $profile = $this->getProfileByUserId($userId);
        return $profile ? (int)$profile['id'] : 0;
    }

    public function getPendingHiringCount(int $farmerProfileId): int
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT COUNT(*) as count FROM hiring_requests WHERE farmer_id = ? AND status = 'pending'"
        );
        mysqli_stmt_bind_param($stmt, "i", $farmerProfileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            return (int)$row['count'];
        }
        return 0;
    }

    public function createProfile(int $userId, string $specialization, int $experienceYears): bool
    {
        $stmt = mysqli_prepare($this->db,
            "INSERT INTO farmer_profiles (user_id, specialization, experience_years, verification_status)
             VALUES (?, ?, ?, 'pending')"
        );
        mysqli_stmt_bind_param($stmt, "isi", $userId, $specialization, $experienceYears);
        return mysqli_stmt_execute($stmt);
    }

    public function getRecentUpdates(int $farmerProfileId, int $limit = 10): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT pu.id, pu.progress_percentage, pu.milestone, pu.description, pu.expense, pu.update_date,
                    fp.title AS project_title, fp.crop
             FROM project_updates pu
             JOIN farming_projects fp ON pu.project_id = fp.id
             WHERE fp.farmer_id = ?
             ORDER BY pu.update_date DESC, pu.id DESC
             LIMIT ?"
        );
        mysqli_stmt_bind_param($stmt, "ii", $farmerProfileId, $limit);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function createProjectUpdate(
        int $projectId,
        float $progressPercentage,
        string $milestone,
        string $description,
        float $expense,
        string $updateDate
    ): bool {
        $stmt = mysqli_prepare($this->db,
            "INSERT INTO project_updates (project_id, progress_percentage, milestone, description, expense, update_date)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "idssds",
            $projectId, $progressPercentage, $milestone, $description, $expense, $updateDate
        );
        return mysqli_stmt_execute($stmt);
    }

    public function ownsProjectWithStatus(int $projectId, int $farmerProfileId, string $statusList): bool
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT id FROM farming_projects
             WHERE id = ? AND farmer_id = ? AND status IN $statusList"
        );
        mysqli_stmt_bind_param($stmt, "ii", $projectId, $farmerProfileId);
        mysqli_stmt_execute($stmt);
        return mysqli_num_rows(mysqli_stmt_get_result($stmt)) > 0;
    }

    public function getHarvests(int $farmerProfileId): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT h.crop, h.quantity, h.quantity_unit, h.estimated_value, h.harvest_date,
                    fp.id AS project_id, fp.title
             FROM harvests h
             JOIN farming_projects fp ON h.project_id = fp.id
             WHERE fp.farmer_id = ?
             ORDER BY h.harvest_date DESC, h.id DESC"
        );
        mysqli_stmt_bind_param($stmt, "i", $farmerProfileId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function getPendingFarmers(): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT fpa.id, fpa.specialization, fpa.experience_years, fpa.bio, fpa.profile_image, fpa.rating,
                    u.id AS user_id, u.name, u.email, u.phone
             FROM farmer_profiles fpa
             JOIN users u ON fpa.user_id = u.id
             WHERE fpa.verification_status = 'pending'
             ORDER BY fpa.created_at ASC"
        );
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function getAllFarmersOverview(): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT fpa.id, fpa.verification_status, fpa.specialization, fpa.experience_years,
                    u.name, u.email
             FROM farmer_profiles fpa
             JOIN users u ON fpa.user_id = u.id
             ORDER BY fpa.verification_status ASC, fpa.id ASC"
        );
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function updateVerificationStatus(int $farmerProfileId, string $newStatus): int
    {
        $stmt = mysqli_prepare($this->db,
            "UPDATE farmer_profiles SET verification_status = ? WHERE id = ? AND verification_status = 'pending'"
        );
        mysqli_stmt_bind_param($stmt, "si", $newStatus, $farmerProfileId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public function searchVerifiedFarmers(string $searchTerm = ''): array
    {
        $sql = "SELECT u.name, u.email, u.phone, fp.id AS farmer_profile_id,
                       fp.experience_years, fp.specialization, fp.bio, fp.rating, fp.profile_image
                FROM users u
                JOIN farmer_profiles fp ON u.id = fp.user_id
                WHERE fp.verification_status = 'approved'";

        if ($searchTerm !== '') {
            $like = "%" . $searchTerm . "%";
            $sql .= " AND (u.name LIKE ? OR fp.specialization LIKE ?)";
            $sql .= " ORDER BY fp.rating DESC, fp.id DESC";
            $stmt = mysqli_prepare($this->db, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $like, $like);
        } else {
            $sql .= " ORDER BY fp.rating DESC, fp.id DESC";
            $stmt = mysqli_prepare($this->db, $sql);
        }

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
