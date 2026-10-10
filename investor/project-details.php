<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/InvestorController.php';

Auth::requireRole('investor');

$investorController = new InvestorController();
$investorController->projectDetails();
extract($GLOBALS['_investor_project_details_data']);

$user_id = Auth::userId();
$username = Auth::username();

require __DIR__ . '/_project-details-view.php';
