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
        $TaskConnection = new TaskCollection($page, self::PAGE_SIZE);
        $totalPages = $TaskConnection->pageTotal();
        $Tasks = $TaskConnection->page();
        /** @var View $view */
        $view = $this->container->{View::class};
        $this->response->setBody(
            $view->render('index', compact(['Tasks', 'page', 'totalPages']))
        );
    }
}
