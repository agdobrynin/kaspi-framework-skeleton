<?php

namespace App\Controllers;

use App\Entity\TaskCollection;
use Kaspi\Controller;
use Kaspi\View;

class Index extends Controller
{
    private const PAGE_SIZE = 6;
    public function __invoke()
    {
        $page = $this->request->getAttribute('page') ?:1;
        // имя поля для сортировки
        $sortFilter['sortField'] = $this->request->getParam('sortField');
        // asc или desc
        $sortFilter['sortOrder'] = strtolower($this->request->getParam('sortOrder'));
        $TaskConnection = new TaskCollection($page, self::PAGE_SIZE, $sortFilter['sortField'], $sortFilter['sortOrder']);
        $Tasks = $TaskConnection->collection()->getEntities();
        $totalPages = $TaskConnection->pageTotal();
        /** @var View $view */
        $view = $this->container->{View::class};
        $sortFilterString = http_build_query($sortFilter);
        $this->response->setBody(
            $view->render('index', compact(['Tasks', 'page', 'totalPages', 'sortFilter', 'sortFilterString']))
        );
    }
}
