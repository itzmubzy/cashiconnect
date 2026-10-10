<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/FarmerController.php';
include_once("../_profit-distribution-helper.php");

Auth::requireRole('farmer');

$user_id = Auth::userId();
$username = Auth::username();

$message = "";
$message_class = "";

$conn = Database::getConnection();

$fp_stmt = mysqli_prepare($conn, "SELECT id FROM farmer_profiles WHERE user_id=?");
mysqli_stmt_bind_param($fp_stmt, "i", $user_id);
mysqli_stmt_execute($fp_stmt);
$farmer = mysqli_fetch_assoc(mysqli_stmt_get_result($fp_stmt));
if (!$farmer) {
    die("Farmer profile not found.");
}
$farmer_profile_id = $farmer['id'];

$harvest_status = "('active', 'completed')";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $project_id = intval($_POST["project_id"] ?? 0);
    $crop = trim($_POST["crop"] ?? "");
    $quantity_raw = trim($_POST["quantity"] ?? "");
    $quantity_unit = trim($_POST["quantity_unit"] ?? "");
    $value_raw = trim($_POST["estimated_value"] ?? "");
    $harvest_date = trim($_POST["harvest_date"] ?? "");
    $description = trim($_POST["description"] ?? "");

    $errors = [];
    if ($project_id <= 0) $errors[] = "Please select a project.";
    if ($crop === "" || mb_strlen($crop) > 150) $errors[] = "Crop is required (max 150 characters).";
    if ($quantity_raw === "" || !is_numeric($quantity_raw) || (float)$quantity_raw <= 0) {
        $errors[] = "Quantity must be a number greater than zero.";
    }
    if ($quantity_unit === "" || mb_strlen($quantity_unit) > 50) $errors[] = "Quantity unit is required (max 50 characters).";
    if ($value_raw === "" || !is_numeric($value_raw) || (float)$value_raw < 0) {
        $errors[] = "Estimated value must be zero or a positive number.";
    }
    if ($harvest_date === "" || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $harvest_date)) {
        $errors[] = "Harvest date is required (YYYY-MM-DD).";
    }

    if (count($errors) > 0) {
        $message = implode(" ", array_map("htmlspecialchars", $errors));
        $message_class = "error-message";
    } else {
        $own_stmt = mysqli_prepare($conn, "SELECT id FROM farming_projects WHERE id = ? AND farmer_id = ? AND status IN $harvest_status");
        mysqli_stmt_bind_param($own_stmt, "ii", $project_id, $farmer_profile_id);
        mysqli_stmt_execute($own_stmt);
        if (mysqli_num_rows(mysqli_stmt_get_result($own_stmt)) === 0) {
            $message = "Invalid project selection, or the project does not belong to you.";
            $message_class = "error-message";
        } else {
            $quantity = round((float)$quantity_raw, 2);
            $estimated_value = round((float)$value_raw, 2);
            $desc_value = ($description === "") ? null : $description;

            mysqli_begin_transaction($conn);
            try {
                $ins_stmt = mysqli_prepare($conn, "INSERT INTO harvests (project_id, crop, quantity, quantity_unit, estimated_value, harvest_date, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($ins_stmt, "isdsdss", $project_id, $crop, $quantity, $quantity_unit, $estimated_value, $harvest_date, $desc_value);
                if (!mysqli_stmt_execute($ins_stmt)) {
                    throw new Exception("Failed to log harvest.");
                }

                $dist_check_stmt = mysqli_prepare($conn, "SELECT status, profit_distributed_at FROM farming_projects WHERE id = ? FOR UPDATE");
                mysqli_stmt_bind_param($dist_check_stmt, "i", $project_id);
                mysqli_stmt_execute($dist_check_stmt);
                $dist_check = mysqli_fetch_assoc(mysqli_stmt_get_result($dist_check_stmt));

                if ($dist_check && $dist_check['status'] === 'completed' && empty($dist_check['profit_distributed_at'])) {
                    $auto_distribution_info = cc_distribute_project_profit($conn, $project_id);
                }

                mysqli_commit($conn);
                header("Location: harvest.php?logged=1");
                exit();
            } catch (Exception $e) {
                mysqli_rollback($conn);
                $message = $e->getMessage();
                $message_class = "error-message";
            }
        }
    }
}

if (isset($_GET["logged"]) && $_GET["logged"] === "1") {
    $message = "Harvest logged successfully!";
    $message_class = "registration-message";
}

$farmerController = new FarmerController();
$farmerController->harvestData();
extract($GLOBALS['_farmer_harvest_data']);

require __DIR__ . '/_harvest-view.php';
?>
