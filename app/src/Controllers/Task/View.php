<?php
namespace App\Controllers\Task;

use App\Entity\Task;
use Kaspi\Controller;
use Kaspi\FlashMessages;
use Kaspi\ResponseCode;
use Kaspi\View as ViewRender;

class View extends Controller
{
    public function __invoke(): void
    {
        $id = $this->request->getAttribute('id');
        $Task = Task::find($id);
        if (!$Task->id) {
            FlashMessages::addError('Задача с Id='.$id.' не найдена');
            $this->response->errorHeader(ResponseCode::NOT_FOUND);
            $this->response->redirect($this->pathFor('main'));
            return;
        }
        /** @var View $view */
        $view = $this->container->{ViewRender::class};
        $this->response->setBody($view->render('task.view', compact('Task')));
    }
}