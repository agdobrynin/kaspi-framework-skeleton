<?php

namespace App\Middleware;

use Kaspi\Middleware;

class TemplateTransform extends Middleware
{
    public function __invoke()
    {
        $this->response->setBody('<!-- microsoft page generator v 2.0-->'.PHP_EOL);
        ($this->next)();
        return $this->response->setBody(PHP_EOL.'<!-- page completed by microsoft page generator-->');
    }
}
