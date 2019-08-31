<?php

namespace App\Controllers;

use Kaspi\Controller;
use Kaspi\FlashMessages;
use Kaspi\View;

class Index extends Controller
{
    public function __invoke()
    {
        /** @var View $view */
        $view = $this->container->{View::class};
        $this->response->setBody(
            $view->render('index')
        );
    }
}
