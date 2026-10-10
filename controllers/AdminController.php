<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/ProjectModel.php';
require_once __DIR__ . '/../models/FarmerModel.php';
require_once __DIR__ . '/../models/AdminModel.php';
require_once __DIR__ . '/../models/InvestmentModel.php';

class AdminController
{
    private UserModel    $userModel;
    private ProjectModel $projectModel;
    private FarmerModel  $farmerModel;
    private AdminModel   $adminModel;
    private InvestmentModel $investmentModel;

    public function __construct()
    {
        $db = Database::getConnection();
        $this->userModel    = new UserModel($db);
        $this->projectModel = new ProjectModel($db);
        $this->farmerModel  = new FarmerModel($db);
        $this->adminModel   = new AdminModel($db);
        $this->investmentModel = new InvestmentModel($db);
    }


    public function dashboard(): void
    {
        $roleCounts      = $this->userModel->getRoleCounts();
        $total_users     = $roleCounts['total'];
        $total_farmers   = $roleCounts['farmer'];
        $total_investors = $roleCounts['investor'];
        $total_landowners = $roleCounts['landowner'];
        $total_projects  = $this->projectModel->getTotalCount();
        $pending_reports = $this->adminModel->getPendingReportsCount();

        $GLOBALS['_admin_dashboard_data'] = compact(
            'total_users', 'total_farmers', 'total_investors',
            'total_landowners', 'total_projects', 'pending_reports'
        );
    }


    public function manageProject(): void
    {
        $message       = '';
        $message_class = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id'], $_POST['action'])) {
            $project_id = intval($_POST['project_id']);
            $action     = $_POST['action'];

            if ($action === 'approve') {
                $affected = $this->projectModel->approveProject($project_id);
            } elseif ($action === 'reject') {
                $affected = $this->projectModel->rejectProject($project_id);
            } else {
                $affected  = 0;
                $message   = 'Invalid action.';
                $message_class = 'error-message';
            }

            if ($message === '' && isset($affected)) {
                if ($affected > 0) {
                    $new_status    = ($action === 'approve') ? 'approved' : 'rejected';
                    $message       = "Project #{$project_id} {$new_status} successfully.";
                    $message_class = 'registration-message';
                } else {
                    $message       = "Project #{$project_id} could not be updated or was already processed.";
                    $message_class = 'error-message';
                }
            }
        }

        $pending_res = $this->projectModel->getPendingProjects();
        $all_res     = $this->projectModel->getAllProjectsOverview();

        $GLOBALS['_admin_manage_project_data'] = compact('message', 'message_class', 'pending_res', 'all_res');
    }


    public function verifyFarmer(): void
    {
        $message       = '';
        $message_class = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['farmer_id'], $_POST['action'])) {
            $farmer_profile_id = intval($_POST['farmer_id']);
            $action            = $_POST['action'];

            if ($action === 'approve' || $action === 'reject') {
                $new_status = ($action === 'approve') ? 'approved' : 'rejected';
                $affected   = $this->farmerModel->updateVerificationStatus($farmer_profile_id, $new_status);

                if ($affected > 0) {
                    $message       = "Farmer profile #{$farmer_profile_id} {$new_status} successfully.";
                    $message_class = 'registration-message';
                } else {
                    $message       = "Farmer profile #{$farmer_profile_id} could not be updated or was already processed.";
                    $message_class = 'error-message';
                }
            } else {
                $message       = 'Invalid action.';
                $message_class = 'error-message';
            }
        }

        $pending_res = $this->farmerModel->getPendingFarmers();
        $all_res     = $this->farmerModel->getAllFarmersOverview();

        $GLOBALS['_admin_verify_farmer_data'] = compact('message', 'message_class', 'pending_res', 'all_res');
    }


    public function manageUsers(): void
    {
        $admin_user_id = Auth::userId();
        $valid_roles   = ['farmer', 'investor', 'landowner', 'admin'];
        $message       = '';
        $message_class = '';

        $role_filter = isset($_GET['role']) ? $_GET['role'] : '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['action'])) {
            $target_user_id = intval($_POST['user_id']);
            $action         = $_POST['action'];

            if ($action === 'activate' || $action === 'suspend') {
                if ($target_user_id === $admin_user_id) {
                    $message       = 'You cannot suspend or activate your own account.';
                    $message_class = 'error-message';
                } else {
                    if ($action === 'suspend') {
                        $affected = $this->userModel->suspendUser($target_user_id);
                    } else {
                        $affected = $this->userModel->activateUser($target_user_id);
                    }

                    if ($affected > 0) {
                        $verb          = ($action === 'suspend') ? 'suspended' : 'activated';
                        $message       = "User #{$target_user_id} {$verb} successfully.";
                        $message_class = 'registration-message';
                    } else {
                        $message       = "User #{$target_user_id} could not be updated.";
                        $message_class = 'error-message';
                    }
                }
            } else {
                $message       = 'Invalid action.';
                $message_class = 'error-message';
            }
        }

        $users_res = $this->userModel->getAllUsers($role_filter);

        $GLOBALS['_admin_manage_users_data'] = compact(
            'message', 'message_class', 'role_filter', 'users_res',
            'admin_user_id', 'valid_roles'
        );
    }


    public function reports(): void
    {
        $message       = '';
        $message_class = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'], $_POST['action'])) {
            $report_id  = intval($_POST['report_id']);
            $action     = $_POST['action'];
            $admin_note = isset($_POST['admin_note']) ? trim($_POST['admin_note']) : '';
            $note_value = ($admin_note === '') ? null : $admin_note;

            if ($action === 'resolve' || $action === 'dismiss') {
                $new_status = ($action === 'resolve') ? 'resolved' : 'dismissed';
                $affected   = $this->adminModel->closeReport($report_id, $new_status, $note_value);

                if ($affected > 0) {
                    $message       = "Report #{$report_id} {$new_status} successfully.";
                    $message_class = 'registration-message';
                } else {
                    $message       = "Report #{$report_id} could not be updated or was already processed.";
                    $message_class = 'error-message';
                }
            } else {
                $message       = 'Invalid action.';
                $message_class = 'error-message';
            }
        }

        $open_res = $this->adminModel->getOpenReports();
        $all_res  = $this->adminModel->getAllReports();

        $GLOBALS['_admin_reports_data'] = compact('message', 'message_class', 'open_res', 'all_res');
    }


    public function finalizeShareout(): void
    {
        $message = '';
        $message_class = '';
        $latest_distribution = null;
        $transaction_started = false;

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['project_id']) && $_POST['action'] === 'finalize') {
                $project_id = intval($_POST['project_id']);

                mysqli_begin_transaction(Database::getConnection());
                $transaction_started = true;

                $latest_distribution = cc_distribute_project_profit(Database::getConnection(), $project_id, Auth::userId());

                mysqli_commit(Database::getConnection());

                error_log(sprintf(
                    "ChasiConnect shareout finalized (admin): project=%d profit=%.2f revenue=%.2f budget=%.2f investor_pool=%.2f farmer=%.2f platform=%.2f remainder=%.2f diff=%.2f",
                    $latest_distribution['project_id'],
                    $latest_distribution['profit'],
                    $latest_distribution['total_revenue'],
                    $latest_distribution['required_budget'],
                    $latest_distribution['investor_pool'],
                    $latest_distribution['farmer_share'],
                    $latest_distribution['platform_share'],
                    $latest_distribution['investor_remainder'],
                    $latest_distribution['reconciliation_diff']
                ));

                $message = 'Final shareout completed for project #' . $project_id . '.';
                $message_class = 'registration-message';
            }
        } catch (Exception $e) {
            if ($transaction_started) {
                mysqli_rollback(Database::getConnection());
            }
            $message = $e->getMessage();
            $message_class = 'error-message';
        }

        $projects_res = $this->investmentModel->getShareoutEligibleProjects();

        $GLOBALS['_admin_finalize_shareout_data'] = compact(
            'message', 'message_class', 'latest_distribution', 'projects_res'
        );
    }
}
