<?php

namespace App\App;


use App\Services\TaskServices;
use App\Validators\ValidateTask;
use App\Repository\TaskRepository;

class Container
{
    public function get(
        string $className
    )
    {
        $taskepository = new TaskRepository();
        $taskServices = new TaskServices($taskepository);
        $validator = new ValidateTask();

        $controller = new $className(
            validator: $validator,
            taskServices: $taskServices
        );

        return $controller;
    }
}
