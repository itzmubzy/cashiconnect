<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/FarmerModel.php';
require_once __DIR__ . '/../models/ProjectModel.php';

class FarmerController
{
    private FarmerModel  $farmerModel;
    private ProjectModel $projectModel;

    public function __construct()
    {
        $db = Database::getConnection();
        $this->farmerModel  = new FarmerModel($db);
        $this->projectModel = new ProjectModel($db);
    }


    public function dashboard(): void
    {
        $userId  = Auth::userId();
        $farmer  = $this->farmerModel->getProfileByUserId($userId);

        $project_count = 0;
        $hiring_count  = 0;
        $shareouts     = [];
        $projects      = [];

        if ($farmer) {
            $farmerProfileId = (int)$farmer['id'];
            $project_count   = $this->projectModel->getProjectCountForFarmer($farmerProfileId);
            $hiring_count    = $this->farmerModel->getPendingHiringCount($farmerProfileId);
            $shareouts       = $this->projectModel->getFarmerShareouts($farmerProfileId);
            $projects        = $this->projectModel->getFarmerProjectsList($farmerProfileId);
        }

        $GLOBALS['_farmer_dashboard_data'] = compact('farmer', 'project_count', 'hiring_count', 'shareouts', 'projects');
    }


    public function createProject(): void
    {
        $userId = Auth::userId();
        $farmer = $this->farmerModel->getProfileByUserId($userId);

        if (!$farmer) {
            die("Farmer profile not found.");
        }
        $farmerProfileId = (int)$farmer['id'];

        $message       = '';
        $message_class = '';

        $lands_res = $this->projectModel->getEligibleLandsForFarmer($farmerProfileId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title       = trim($_POST['title']           ?? '');
            $crop        = trim($_POST['crop']            ?? '');
            $budget_raw  = trim($_POST['farming_costs']   ?? '');
            $duration_raw = trim($_POST['duration_months'] ?? '');
            $description = trim($_POST['description']     ?? '');
            $land_id     = intval($_POST['land_id']       ?? 0);

            $errors = [];
            if ($title === '')       $errors[] = 'Project title is required.';
            if ($crop === '')        $errors[] = 'Crop type is required.';
            if ($budget_raw === '' || !is_numeric($budget_raw) || (float)$budget_raw <= 0)
                $errors[] = 'Farming costs must be a number greater than zero.';
            if ($duration_raw === '' || !is_numeric($duration_raw) || (int)$duration_raw < 1)
                $errors[] = 'Duration must be at least 1 month.';
            if ($description === '') $errors[] = 'Description is required.';
            if ($land_id <= 0)       $errors[] = 'Please select a land.';

            if (count($errors) > 0) {
                $message       = implode(' ', array_map('htmlspecialchars', $errors));
                $message_class = 'error-message';
            } else {
                $chosenLand = $this->projectModel->validateLandForFarmer($farmerProfileId, $land_id);

                if (!$chosenLand) {
                    $message       = 'Invalid land selection or this land is already claimed by another project.';
                    $message_class = 'error-message';
                } else {
                    $farmingCosts    = round((float)$budget_raw, 2);
                    $leaseAmount     = round((float)$chosenLand['lease_amount'], 2);
                    $requiredBudget  = round($farmingCosts + $leaseAmount, 2);
                    $durationMonths  = (int)$duration_raw;

                    $created = $this->projectModel->createProject(
                        $farmerProfileId, $land_id, $title, $crop, $description, $requiredBudget, $durationMonths
                    );

                    if ($created) {
                        header("Location: farmer-dashboard.php?created=1");
                        exit();
                    } else {
                        $message       = 'Database error: failed to submit the project.';
                        $message_class = 'error-message';
                    }
                }
            }
        }

        $GLOBALS['_farmer_create_project_data'] = compact('farmer', 'lands_res', 'message', 'message_class');
    }


    public function projectUpdate(): void
    {
        $userId = Auth::userId();
        $farmer = $this->farmerModel->getProfileByUserId($userId);

        if (!$farmer) {
            die("Farmer profile not found.");
        }
        $farmerProfileId = (int)$farmer['id'];
        $postableStatus  = "('approved', 'active', 'completed')";

        $message       = '';
        $message_class = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $project_id     = intval($_POST['project_id']         ?? 0);
            $milestone      = trim($_POST['milestone']            ?? '');
            $description    = trim($_POST['description']          ?? '');
            $progress_raw   = trim($_POST['progress_percentage']  ?? '');
            $expense_raw    = trim($_POST['expense']              ?? '');
            $update_date    = trim($_POST['update_date']          ?? '');

            $errors = [];
            if ($project_id <= 0) $errors[] = 'Please select a project.';
            if ($milestone === '' || mb_strlen($milestone) > 200) $errors[] = 'Milestone is required (max 200 characters).';
            if ($description === '') $errors[] = 'Description is required.';
            if ($progress_raw === '' || !is_numeric($progress_raw) || (float)$progress_raw < 0 || (float)$progress_raw > 100)
                $errors[] = 'Progress percentage must be a number between 0 and 100.';
            if ($expense_raw !== '' && (!is_numeric($expense_raw) || (float)$expense_raw < 0))
                $errors[] = 'Expense must be zero or a positive number.';
            if ($update_date === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $update_date))
                $errors[] = 'Update date is required (YYYY-MM-DD).';

            if (count($errors) > 0) {
                $message       = implode(' ', array_map('htmlspecialchars', $errors));
                $message_class = 'error-message';
            } elseif (!$this->farmerModel->ownsProjectWithStatus($project_id, $farmerProfileId, $postableStatus)) {
                $message       = 'Invalid project selection, or the project does not belong to you.';
                $message_class = 'error-message';
            } else {
                $progress = round((float)$progress_raw, 2);
                $expense  = ($expense_raw === '') ? 0.00 : round((float)$expense_raw, 2);

                $created = $this->farmerModel->createProjectUpdate($project_id, $progress, $milestone, $description, $expense, $update_date);
                if ($created) {
                    header("Location: project-update.php?posted=1");
                    exit();
                } else {
                    $message       = 'Database error: failed to post the update.';
                    $message_class = 'error-message';
                }
            }
        }

        if (isset($_GET['posted']) && $_GET['posted'] === '1') {
            $message       = 'Progress update posted successfully!';
            $message_class = 'registration-message';
        }

        $projects_res = $this->projectModel->getFarmerPostableProjects($farmerProfileId);
        $updates_res  = $this->farmerModel->getRecentUpdates($farmerProfileId, 10);

        $GLOBALS['_farmer_project_update_data'] = compact('farmer', 'projects_res', 'updates_res', 'message', 'message_class');
    }


    public function projectDetails(): void
    {
        $userId = Auth::userId();
        $farmer = $this->farmerModel->getProfileByUserId($userId);

        if (!$farmer) {
            die("Farmer profile not found.");
        }
        $farmerProfileId = (int)$farmer['id'];

        $projectId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $project   = $projectId > 0
            ? $this->projectModel->getFarmerProjectById($projectId, $farmerProfileId)
            : null;

        $investors = [];
        $stats     = null;
        $lease     = null;

        if ($project) {
            $investors = $this->projectModel->getFarmerProjectInvestors($projectId);
            $stats     = $this->projectModel->getFarmerProjectStats(
                $projectId,
                (float)$project['required_budget']
            );
            $lease = $this->projectModel->getLandLeaseInfo((int)$project['land_id']);
        }

        $GLOBALS['_farmer_project_details_data'] = compact('farmer', 'project', 'investors', 'stats', 'lease');
    }


    public function harvestData(): void
    {
        $userId = Auth::userId();
        $farmer = $this->farmerModel->getProfileByUserId($userId);

        if (!$farmer) {
            die("Farmer profile not found.");
        }
        $farmerProfileId = (int)$farmer['id'];

        $projects_res = $this->projectModel->getFarmerHarvestableProjects($farmerProfileId);
        $harvests_res = $this->farmerModel->getHarvests($farmerProfileId);

        $GLOBALS['_farmer_harvest_data'] = compact('farmer', 'projects_res', 'harvests_res');
    }
}
