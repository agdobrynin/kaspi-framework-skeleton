<?php

namespace App\Controllers;

use App\Auth;
use App\Entity\Task;
use Kaspi\Exception\Core\AppException;
use Kaspi\FlashMessages;
use Kaspi\Orm\Collection;
use Kaspi\Orm\OrmException;
use Faker\Factory;

use Kaspi\Controller;

class FakeData extends Controller
{
    public const MAX_TASK = 20;

    public function create(): void
    {
        $Faker = Factory::create('ru_RU');

        try {
            $Task = new Task();
            $existCountRows = (new Collection($Task))->count();
            if ($existCountRows >= self::MAX_TASK) {
                FlashMessages::addWarning('В базе максимальное количество задач, '.self::MAX_TASK.' шт.');
                $this->response->redirect($this->pathFor('main'));

                return;
            }
            $Task->getEntityBuilder()->useTransaction = false;
            $Task->getEntityBuilder()::getPdo()->beginTransaction();
            for ($i = 0; $i < self::MAX_TASK; ++$i) {
                $Task->userName = $Faker->name;
                $Task->email = $Faker->email;
                $Task->content = implode(PHP_EOL.PHP_EOL, $Faker->paragraphs());

                $Task->save();
                $Task->id = null;
            }
            $Task->getEntityBuilder()::getPdo()->commit();
        } catch (OrmException $exception) {
            throw new AppException($exception->getMessage());
        }
        FlashMessages::addSuccess('Добавлено '.self::MAX_TASK.' задач');
        $this->response->redirect($this->pathFor('main'));
    }

    public function delete(): void
    {
        if (!Auth::isAuth()) {
            FlashMessages::addWarning('Только авторизованый пользователь может удалять данные');
            $this->response->redirect($this->pathFor('login'));

            return;
        }
        try {
            $countRows = Task::truncate();
        } catch (OrmException $exception) {
            throw new AppException($exception->getMessage());
        }
        FlashMessages::addSuccess('Удалено '.$countRows.' задач');
        $this->response->redirect($this->pathFor('main'));
    }
}
