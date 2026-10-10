<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Cookie.php';
require_once __DIR__ . '/../models/ProjectModel.php';

class ProjectController
{
    private ProjectModel $projectModel;

    public function __construct()
    {
        $db = Database::getConnection();
        $this->projectModel = new ProjectModel($db);
    }


    public function browse(): void
    {
        $search = '';
        if (isset($_GET['search'])) {
            $search = trim($_GET['search']);
        } elseif (Cookie::has('last_project_search')) {
            $search = Cookie::get('last_project_search');
        }

        $filter = isset($_GET['filter']) ? trim($_GET['filter']) : 'all';

        $projects = $this->projectModel->getApprovedProjects($search, $filter);

        $GLOBALS['_project_browse_data'] = compact('projects', 'search', 'filter');
    }


    public function search(): void
    {
        Auth::requireRole('investor');

        $keyword = trim($_GET['keyword'] ?? '');

        $keyword = strip_tags($keyword);
        $keyword = mb_substr($keyword, 0, 100);

        if ($keyword !== '') {
            Cookie::set('last_project_search', $keyword);
        } else {
            Cookie::delete('last_project_search');
        }

        $projects = $this->projectModel->searchProjects($keyword);

        require __DIR__ . '/../views/investor/_search-results-partial.php';
    }
}
