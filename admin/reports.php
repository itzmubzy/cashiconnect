<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/AdminController.php';

Auth::requireRole('admin');

$adminController = new AdminController();
$adminController->reports();
extract($GLOBALS['_admin_reports_data']);

$user_id = Auth::userId();
$username = Auth::username();

require __DIR__ . '/_reports-view.php';
