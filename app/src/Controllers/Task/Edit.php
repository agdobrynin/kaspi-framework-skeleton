<?php

namespace App\Controllers\Task;

use App\Auth;
use App\Entity\Task;
use Kaspi\Controller;
use Kaspi\View;
use Kaspi\FlashMessages;
use Kaspi\ResponseCode;

class Edit extends Controller
{
    public function __invoke()
    {
        if (!Auth::isAuth()) {
            $this->response->errorHeader(ResponseCode::UNAUTHORIZED);
            FlashMessages::addWarning('Редактировать задачу может только администратор');
            $this->response->redirect($this->pathFor('login'));
            return;
        }
        $id = $this->request->getAttribute('id');
        $Task = Task::find($id);
        if (!$Task->id) {
            FlashMessages::addError('Задача с Id='.$id.' не найдена');
            $this->response->errorHeader(ResponseCode::NOT_FOUND);
            $this->response->redirect($this->pathFor('main'));
            return;
        }
        /** @var View $view */
        $view = $this->container->{View::class};
        $this->response->setBody($view->render('task.form', compact('Task')));
    }
}
