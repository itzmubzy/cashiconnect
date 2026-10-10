<?php

class UserModel
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function findByUsernameOrEmail(string $identifier): ?array
    {
        $stmt = mysqli_prepare($this->db, "SELECT * FROM users WHERE name = ? OR email = ?");
        mysqli_stmt_bind_param($stmt, "ss", $identifier, $identifier);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    public function emailExists(string $email): bool
    {
        $stmt = mysqli_prepare($this->db, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return ($result && mysqli_num_rows($result) > 0);
    }

    public function createUser(string $name, string $email, string $hashedPassword, string $phone, string $role): int
    {
        $stmt = mysqli_prepare($this->db,
            "INSERT INTO users (name, email, password, phone, role, status) VALUES (?, ?, ?, ?, ?, 'active')"
        );
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $hashedPassword, $phone, $role);
        if (mysqli_stmt_execute($stmt)) {
            return (int)mysqli_insert_id($this->db);
        }
        return 0;
    }

    public function deleteUser(int $userId): void
    {
        $stmt = mysqli_prepare($this->db, "DELETE FROM users WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
    }

    public function getAllUsers(string $roleFilter = ''): mysqli_result|false
    {
        $validRoles = ['admin', 'farmer', 'investor', 'landowner'];
        if ($roleFilter !== '' && in_array($roleFilter, $validRoles, true)) {
            $stmt = mysqli_prepare($this->db,
                "SELECT id, name, email, phone, role, status, created_at FROM users WHERE role = ? ORDER BY id ASC"
            );
            mysqli_stmt_bind_param($stmt, "s", $roleFilter);
        } else {
            $stmt = mysqli_prepare($this->db,
                "SELECT id, name, email, phone, role, status, created_at FROM users ORDER BY id ASC"
            );
        }
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function suspendUser(int $targetUserId): int
    {
        $stmt = mysqli_prepare($this->db,
            "UPDATE users SET status = 'suspended' WHERE id = ? AND status = 'active'"
        );
        mysqli_stmt_bind_param($stmt, "i", $targetUserId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public function activateUser(int $targetUserId): int
    {
        $stmt = mysqli_prepare($this->db,
            "UPDATE users SET status = 'active' WHERE id = ? AND status = 'suspended'"
        );
        mysqli_stmt_bind_param($stmt, "i", $targetUserId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public function getRoleCounts(): array
    {
        $counts = ['farmer' => 0, 'investor' => 0, 'landowner' => 0, 'total' => 0];
        $res = mysqli_query($this->db, "SELECT role, COUNT(*) as count FROM users GROUP BY role");
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                if (isset($counts[$row['role']])) {
                    $counts[$row['role']] = (int)$row['count'];
                }
            }
        }
        $u_res = mysqli_query($this->db, "SELECT COUNT(*) as count FROM users");
        if ($u_res && $u_row = mysqli_fetch_assoc($u_res)) {
            $counts['total'] = (int)$u_row['count'];
        }
        return $counts;
    }
}
