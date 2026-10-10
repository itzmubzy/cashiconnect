<?php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/FarmerController.php';

Auth::requireRole('farmer');

$farmerController = new FarmerController();
$farmerController->createProject();
extract($GLOBALS['_farmer_create_project_data']);

$user_id = Auth::userId();
$username = Auth::username();

require __DIR__ . '/_create-project-view.php';
