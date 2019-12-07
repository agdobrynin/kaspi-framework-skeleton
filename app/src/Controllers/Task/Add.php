<?php

namespace App\Controllers\Task;

use App\Entity\City;
use App\Entity\Category;
use App\Entity\Task;
use Kaspi\Controller;
use Kaspi\Orm\Collection;
use Kaspi\View;

class Add extends Controller
{
    public function __invoke(): void
    {
        $cities = (new Collection(new City()))->getEntities();
        $categories = (new Collection(new Category()))->getEntities();
        $Task = new Task();
        /** @var View $view */
        $view = $this->container->{View::class};
        $this->response->setBody($view->render('task.form', compact(['cities', 'categories', 'Task'])));
    }

}
