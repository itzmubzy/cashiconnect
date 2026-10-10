<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/InvestorModel.php';
require_once __DIR__ . '/../models/InvestmentModel.php';
require_once __DIR__ . '/../models/ProjectModel.php';

class InvestorController
{
    private InvestorModel  $investorModel;
    private InvestmentModel $investmentModel;
    private ProjectModel   $projectModel;

    public function __construct()
    {
        $db = Database::getConnection();
        $this->investorModel   = new InvestorModel($db);
        $this->investmentModel = new InvestmentModel($db);
        $this->projectModel    = new ProjectModel($db);
    }


    public function myInvestments(): void
    {
        $userId            = Auth::userId();
        $investorProfileId = $this->investorModel->getProfileId($userId);

        if ($investorProfileId === 0) {
            die("Investor profile not found.");
        }

        $investments_res = $this->investmentModel->getInvestmentsByInvestor($investorProfileId);
        $total_row       = $this->investmentModel->getPortfolioTotals($investorProfileId);

        $GLOBALS['_investor_my_investments_data'] = compact('investments_res', 'total_row');
    }


    public function projectDetails(): void
    {
        $userId            = Auth::userId();
        $projectId         = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $investorProfileId = $this->investorModel->getProfileId($userId);

        $project = $this->projectModel->getProjectById($projectId);

        $updates      = [];
        $distribution = [
            'own_profit_share' => null,
            'own_total_amount' => null,
            'other_investors'  => [],
        ];
        $funding_breakdown = [
            'lease_amount'  => null,
            'farming_costs' => null,
        ];

        if ($project) {
            $updates = $this->projectModel->getProjectUpdates($projectId);

            if (!empty($project['profit_distributed_at']) && $investorProfileId > 0) {
                $ownDist = $this->investmentModel->getOwnDistribution($projectId, $investorProfileId);
                $distribution['own_profit_share'] = $ownDist['own_profit_share'];
                $distribution['own_total_amount'] = $ownDist['own_total_amount'];
                $distribution['other_investors']  = $this->investmentModel->getOtherInvestorsDistribution($projectId, $investorProfileId);
            }

            $leaseAmount = $this->investmentModel->getLandLeaseAmount((int)$project['land_id']);
            $funding_breakdown['lease_amount']  = $leaseAmount;
            $funding_breakdown['farming_costs'] = round((float)$project['required_budget'] - $leaseAmount, 2);
        }

        $GLOBALS['_investor_project_details_data'] = compact('project', 'updates', 'distribution', 'funding_breakdown');
    }
}
