<?php

class LandownerModel
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function getProfileByUserId(int $userId): ?array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT * FROM landowner_profiles WHERE user_id = ?"
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

    public function createProfile(int $userId, string $address): bool
    {
        $stmt = mysqli_prepare($this->db,
            "INSERT INTO landowner_profiles (user_id, address) VALUES (?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "is", $userId, $address);
        return mysqli_stmt_execute($stmt);
    }

    public function getLandsCount(int $landownerProfileId): int
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT COUNT(*) as count FROM lands WHERE landowner_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $landownerProfileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            return (int)$row['count'];
        }
        return 0;
    }

    public function getHiringCount(int $landownerProfileId): int
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT COUNT(*) as count FROM hiring_requests WHERE landowner_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $landownerProfileId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            return (int)$row['count'];
        }
        return 0;
    }

    public function getRecentLands(int $landownerProfileId, int $limit = 5): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT id, title, area, area_unit, availability_status
             FROM lands WHERE landowner_id = ?
             ORDER BY id DESC LIMIT ?"
        );
        mysqli_stmt_bind_param($stmt, "ii", $landownerProfileId, $limit);
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

    public function getAcceptedLeaseOffers(int $landownerProfileId): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT hr.id, hr.lease_amount, hr.lease_paid_at, hr.status, hr.requested_at,
                     l.title AS land_title, u.name AS farmer_name
             FROM hiring_requests hr
             JOIN lands l ON hr.land_id = l.id
             JOIN farmer_profiles fp ON hr.farmer_id = fp.id
             JOIN users u ON fp.user_id = u.id
             WHERE hr.landowner_id = ? AND hr.status = 'accepted'
             ORDER BY hr.requested_at DESC LIMIT 10"
        );
        mysqli_stmt_bind_param($stmt, "i", $landownerProfileId);
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


    public function addLand(
        int $landownerId,
        string $title,
        string $location,
        float $area,
        string $areaUnit,
        string $soilType,
        string $landType,
        string $description,
        ?string $imagePath,
        string $availabilityStatus
    ): bool {
        $stmt = mysqli_prepare($this->db,
            "INSERT INTO lands (landowner_id, title, location, area, area_unit, soil_type, land_type, description, image, availability_status)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "issdssssss",
            $landownerId, $title, $location, $area, $areaUnit, $soilType, $landType, $description, $imagePath, $availabilityStatus
        );
        return mysqli_stmt_execute($stmt);
    }

    public function getLandsByLandownerId(int $landownerId): array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT * FROM lands WHERE landowner_id = ? ORDER BY id DESC"
        );
        mysqli_stmt_bind_param($stmt, "i", $landownerId);
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

    public function getLandByIdAndOwner(int $landId, int $landownerId): ?array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT * FROM lands WHERE id = ? AND landowner_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "ii", $landId, $landownerId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
    }

    public function updateLand(
        int $landId,
        string $title,
        string $location,
        float $area,
        string $areaUnit,
        string $soilType,
        string $landType,
        string $description,
        ?string $imagePath,
        string $availabilityStatus
    ): bool {
        $stmt = mysqli_prepare($this->db,
            "UPDATE lands SET title = ?, location = ?, area = ?, area_unit = ?, soil_type = ?, land_type = ?, description = ?, image = ?, availability_status = ?
             WHERE id = ?"
        );
        mysqli_stmt_bind_param($stmt, "sssdssssssi",
            $title, $location, $area, $areaUnit, $soilType, $landType, $description, $imagePath, $availabilityStatus, $landId
        );
        return mysqli_stmt_execute($stmt);
    }

    public function deleteLand(int $landId): bool
    {
        $stmt = mysqli_prepare($this->db, "DELETE FROM lands WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $landId);
        return mysqli_stmt_execute($stmt);
    }

    public function getLandsCountByOwner(int $landownerId): int
    {
        return $this->getLandsCount($landownerId);
    }
}
