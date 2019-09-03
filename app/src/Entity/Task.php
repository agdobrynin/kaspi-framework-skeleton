<?php

namespace App\Entity;

use Kaspi\Orm\Entity;

class Task extends Entity
{
    public $userName;
    public $email;
    public $content = '';
    public $completed = 0;
    public $editByAdmin = 0;
}
