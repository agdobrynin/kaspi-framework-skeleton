<?php

namespace App\Entity;

use Kaspi\Orm\Entity;
use Kaspi\Orm\Relation;

class Category extends Entity
{
    protected $table = 'Category';
    public $name;

    protected $hasMany = [
        'tasks' => [
            Relation::ENTITY_CLASS => Task::class,
            Relation::THROUGH => 'TaskToCategory',
            Relation::FOREIGN_KEY => 'category_id',
            Relation::FOREIGN_KEY_THROUGHT => 'task_id',
        ],
    ];
}
