<?php

namespace App\Entity;

use Kaspi\Orm\Entity;
use Kaspi\Orm\Relation;

class City extends Entity
{
    protected $table = 'City';
    public $name;

    protected $hasMany = [
        'tasks' => [
            Relation::ENTITY_CLASS => Task::class,
            Relation::FOREIGN_KEY => 'city_id',
        ],
    ];

    /**
     * @return \Iterator|Entity
     */
    public function tasks(): \Iterator
    {
        return $this->tasks;
    }
}
