<?php

namespace App\Controllers\Task;

use Kaspi\Controller;
use Kaspi\View;

class Add extends Controller
{
    public function __invoke(): void
    {
        /** @var View $view */
        $view = $this->container->{View::class};
        $this->response->setBody($view->render('task.form'));
    }

}
