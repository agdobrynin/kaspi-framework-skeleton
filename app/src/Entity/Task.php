<?php

namespace App\Entity;

use Kaspi\Orm\Entity;
use Kaspi\Orm\Relation;

/**
 * @property  City city
 * @property  \Iterator|Category categories
 */
class Task extends Entity
{
    public $userName;
    public $email;
    public $content = '';
    public $completed = 0;
    public $editByAdmin = 0;

    protected $hasMany = [
        /*
            SELECT Category.*, Tasks.id as relatedId from Category
            LEFT JOIN TaskToCategory on TaskToCategory.category_id = Category.id
            LEFT JOIN Tasks on TaskToCategory.task_id = Tasks.id
            WHERE Tasks.id = ?
         */
        'categories' => [
            Relation::ENTITY_CLASS => Category::class,
            Relation::THROUGH => 'TaskToCategory',
            Relation::FOREIGN_KEY => 'task_id',
            Relation::FOREIGN_KEY_THROUGHT => 'category_id',
        ]
    ];

    protected $hasOne = [
        'city' => [
            Relation::ENTITY_CLASS => City::class,
            Relation::FOREIGN_KEY => 'city_id',
        ],
    ];

    public function City(): City
    {
        return $this->city;
    }
}
