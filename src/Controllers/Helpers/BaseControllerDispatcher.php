<?php

declare(strict_types=1);

namespace App\Controllers\Helpers;

use App\Controllers\interfaces\ControllerInterface;

abstract class BaseControllerDispatcher
{
    protected /* ControllerInterface */ $controller;

    abstract public function initController(): void;

    public function getController()// : ControllerInterface
    {
        return $this->controller;
    }
}
