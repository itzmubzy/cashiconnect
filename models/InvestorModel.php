<?php

class InvestorModel
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function getProfileByUserId(int $userId): ?array
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT * FROM investor_profiles WHERE user_id = ?"
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

    public function createProfile(int $userId): bool
    {
        $stmt = mysqli_prepare($this->db,
            "INSERT INTO investor_profiles (user_id) VALUES (?)"
        );
        mysqli_stmt_bind_param($stmt, "i", $userId);
        return mysqli_stmt_execute($stmt);
    }
}
