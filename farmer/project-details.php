<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/FarmerController.php';
include_once(__DIR__ . '/../_profit-distribution-helper.php');

Auth::requireRole('farmer');

$user_id = Auth::userId();
$username = Auth::username();

$conn = Database::getConnection();

$message = "";
$message_class = "";
$distribution_result = null;

$fp_stmt = mysqli_prepare($conn, "SELECT id FROM farmer_profiles WHERE user_id=?");
mysqli_stmt_bind_param($fp_stmt, "i", $user_id);
mysqli_stmt_execute($fp_stmt);
$farmer_row = mysqli_fetch_assoc(mysqli_stmt_get_result($fp_stmt));
if (!$farmer_row) {
    die("Farmer profile not found.");
}
$farmer_profile_id = (int)$farmer_row['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "complete_project") {
    $project_id = intval($_POST["project_id"] ?? 0);

    $own_stmt = mysqli_prepare($conn,
        "SELECT id FROM farming_projects
         WHERE id = ? AND farmer_id = ? AND status = 'active'");
    mysqli_stmt_bind_param($own_stmt, "ii", $project_id, $farmer_profile_id);
    mysqli_stmt_execute($own_stmt);
    if (mysqli_num_rows(mysqli_stmt_get_result($own_stmt)) === 0) {
        $message = "This project cannot be completed (it may not exist, may not be yours, or is not in the fully-funded 'active' state).";
        $message_class = "error-message";
    } else {
        mysqli_begin_transaction($conn);
        try {
            $complete_stmt = mysqli_prepare($conn,
                "UPDATE farming_projects
                 SET status = 'completed', progress_percentage = 100, completed_at = NOW()
                 WHERE id = ? AND farmer_id = ? AND status = 'active'");
            mysqli_stmt_bind_param($complete_stmt, "ii", $project_id, $farmer_profile_id);
            mysqli_stmt_execute($complete_stmt);
            if (mysqli_stmt_affected_rows($complete_stmt) < 1) {
                throw new Exception("This project was already completed by a previous request. No action was taken.");
            }

            try {
                $distribution_result = cc_distribute_project_profit($conn, $project_id);
                mysqli_commit($conn);
                $message = "Project marked 100% complete and profit distributed successfully.";
                $message_class = "registration-message";
            } catch (Exception $dist_ex) {
                mysqli_commit($conn);
                $message = "Project marked 100% complete. Profit distribution is pending: "
                    . htmlspecialchars($dist_ex->getMessage());
                $message_class = "registration-message";
            }
        } catch (Exception $e) {
            mysqli_rollback($conn);
            $message = $e->getMessage();
            $message_class = "error-message";
        }
    }
}

$farmerController = new FarmerController();
$farmerController->projectDetails();
extract($GLOBALS['_farmer_project_details_data']);

require __DIR__ . '/_project-details-view.php';
?>