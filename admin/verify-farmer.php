<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/AdminController.php';

Auth::requireRole('admin');

$adminController = new AdminController();
$adminController->verifyFarmer();
extract($GLOBALS['_admin_verify_farmer_data']);

$user_id = Auth::userId();
$username = Auth::username();

require __DIR__ . '/_verify-farmer-view.php';
