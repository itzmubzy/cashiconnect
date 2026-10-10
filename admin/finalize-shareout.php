<?php

require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../_profit-distribution-helper.php';

Auth::requireRole('admin');

$controller = new AdminController();
$controller->finalizeShareout();

require_once __DIR__ . '/../views/admin/finalize-shareout-view.php';
