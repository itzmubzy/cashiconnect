<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../controllers/InvestorController.php';

Auth::requireRole('investor');

$investorController = new InvestorController();
$investorController->myInvestments();
extract($GLOBALS['_investor_my_investments_data']);

$user_id = Auth::userId();
$username = Auth::username();

require __DIR__ . '/_my-investments-view.php';
