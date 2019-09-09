<?php

namespace App\Entity;

use Kaspi\Orm\Entity;

/**
 * Укороченное описание entity для выборки в коллекции, без поля контент.
 * Class TaskEntityCollection
 * @package App\Entity
 */
class TaskEntityCollection extends Entity
{
    /** @var string Имя таблицы Entity */
    protected $table = 'Tasks';
    public $userName;
    public $email;
    public $completed;
    public $editByAdmin;
}
