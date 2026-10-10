<?php

require_once __DIR__ . '/../controllers/LandownerController.php';
require_once __DIR__ . '/../core/Auth.php';

Auth::requireRole('landowner');

$controller = new LandownerController();
$controller->farmerList();

require_once __DIR__ . '/../views/landowner/farmer-list-view.php';
