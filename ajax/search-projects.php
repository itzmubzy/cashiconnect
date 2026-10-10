<?php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/ProjectController.php';

Auth::requireRole('investor');

$controller = new ProjectController();
$controller->search();
