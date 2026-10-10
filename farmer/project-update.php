<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/FarmerController.php';

Auth::requireRole('farmer');

$farmerController = new FarmerController();
$farmerController->projectUpdate();
extract($GLOBALS['_farmer_project_update_data']);

$user_id = Auth::userId();
$username = Auth::username();

require __DIR__ . '/_project-update-view.php';
