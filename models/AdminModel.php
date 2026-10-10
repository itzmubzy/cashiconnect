<?php

class AdminModel
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function getPendingReportsCount(): int
    {
        $res = mysqli_query($this->db, "SELECT COUNT(*) as count FROM reports WHERE status = 'pending'");
        if ($res && $row = mysqli_fetch_assoc($res)) {
            return (int)$row['count'];
        }
        return 0;
    }

    public function getOpenReports(): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT r.id, r.report_type, r.subject, r.description, r.status, r.created_at,
                    ru.name AS reporter_name, ru.email AS reporter_email,
                    tu.name AS reported_user_name, tu.email AS reported_user_email,
                    fp.title AS project_title, fp.crop AS project_crop
             FROM reports r
             JOIN users ru ON r.reporter_id = ru.id
             LEFT JOIN users tu ON r.reported_user_id = tu.id
             LEFT JOIN farming_projects fp ON r.project_id = fp.id
             WHERE r.status IN ('pending', 'reviewing')
             ORDER BY r.created_at ASC"
        );
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function getAllReports(): mysqli_result|false
    {
        $stmt = mysqli_prepare($this->db,
            "SELECT r.id, r.report_type, r.subject, r.status, r.admin_note, r.resolved_at, r.created_at,
                    ru.name AS reporter_name,
                    tu.name AS reported_user_name,
                    fp.title AS project_title
             FROM reports r
             JOIN users ru ON r.reporter_id = ru.id
             LEFT JOIN users tu ON r.reported_user_id = tu.id
             LEFT JOIN farming_projects fp ON r.project_id = fp.id
             ORDER BY r.id ASC"
        );
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    public function closeReport(int $reportId, string $newStatus, ?string $adminNote): int
    {
        $stmt = mysqli_prepare($this->db,
            "UPDATE reports SET status = ?, admin_note = ?, resolved_at = NOW()
             WHERE id = ? AND status IN ('pending', 'reviewing')"
        );
        mysqli_stmt_bind_param($stmt, "ssi", $newStatus, $adminNote, $reportId);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }
}
