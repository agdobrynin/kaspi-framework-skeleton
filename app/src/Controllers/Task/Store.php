<?php

namespace App\Controllers\Task;

use App\Auth;
use App\Entity\Category;
use App\Entity\City;
use App\Entity\Task;
use Kaspi\Controller;
use Kaspi\FlashMessages;
use Kaspi\Orm\Collection;
use Kaspi\Orm\Query\Where;
use Kaspi\View;

class Store extends Controller
{
    public function __invoke()
    {
        $validateError = false;

        /** @var Task $Task */
        $Task = Task::find($this->request->getParam('taskId'));

        // Редактировать может задачу только админ
        if (!Auth::isAuth() && $Task->id) {
            FlashMessages::addError('Только авторизованй админ может изменять запись');
            $this->response->redirect($this->pathFor('main'));
            return;
        }
        // на существующей задаче нельзя менять email
        if (!$Task->id) {
            $Task->email = trim($this->request->getParam('email'));
        }
        if (!filter_var($Task->email, FILTER_VALIDATE_EMAIL)) {
            FlashMessages::addFormValidator('Неверный формат email адреса!', 'email');
            $validateError = true;
        }
        // Проверить на уникальность email при создании
        if (empty($Task->id) && Task::find(['email', $Task->email])->id) {
            FlashMessages::addFormValidator('Такой email уже зарегистрирован в базе', 'email');
            $validateError = true;
        }

        // валидация Имя
        // на существующей задаче нельзя менять имя пользователя
        if (!$Task->id) {
            $Task->userName = trim($this->request->getParam('userName'));
        }
        if (empty($Task->userName) || strlen($Task->userName) < 2) {
            FlashMessages::addFormValidator('Неверный формат Имени! Минимальная длина 2 символа', 'userName');
            $validateError = true;
        }

        // валидация текста задачи
        $Task->content = trim($this->request->getParam('content'));
        if (empty($Task->content) || strlen($Task->content) < 10) {
            FlashMessages::addFormValidator('Задача должны быть более 10 символов', 'content');
            $validateError = true;
        }

        // Привязать категории
        $where = (new Where())->addIn('id', $this->request->getParam('categories') ?: []);
        $taskCategoryIds = [];
        if ($Task->category = (new Collection(new Category()))->where($where)->toArray()) {
            // заполняем временную переменную с id-шниками категорий чтобы в шаблоне отметить нужные
            foreach ($Task->category as $category) {
                $taskCategoryIds[] = $category->id;
            }
        } else {
            FlashMessages::addFormValidator('Необходимо отместить хотя бы один тип задачи', 'categories');
            $validateError = true;
        }

        // Прявязать город
        $city = City::find($this->request->getParam('city_id'));
        $Task->city = $city;
        $cities = (new Collection(new City()))->getEntities();

        $categories = (new Collection(new Category()))->getEntities();
        // С валидацией беда
        if ($validateError) {
            $this->response->setBody($this->container->{View::class}->render('task.form', compact(['Task', 'cities', 'categories', 'taskCategoryIds'])));
            return;
        }

        // Валидация прошла успешно
        // Если админ, то ему можно еще менять признак выполнения задачи
        if (Auth::isAuth() && $Task->id) {
            $Task->completed = !empty($this->request->getParam('completed')) ? 1 : 0;
            $Task->editByAdmin = 1;
        }

        $taskId = $Task->save();
        //Перенаправление на страницу просмотра задачи
        $this->response->redirect($this->pathFor('task.view', ['id' => $taskId]));
    }
}
