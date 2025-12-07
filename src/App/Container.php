<?php

namespace App\App;

use App\DB\DataBaseConnectios;
use App\Services\TaskServices;
use App\Validators\ValidateTask;
use App\Repository\TaskRepository;
use App\Repository\StatusRepository;
use App\Services\StatusService;
use App\Validators\ValidateContext;

class Container
{
    public function get(string $className)
    {
        $db = DataBaseConnectios::getInstance();
        // $queryBuilder = new \App\DB\QueryBuilder\QueryBuilder($db);

        $statusRepository = new StatusRepository($db);
        $statusService = new StatusService($statusRepository);

        $taskepository = new TaskRepository($db);
        $taskServices = new TaskServices($taskepository, $statusService);

        $context = new ValidateContext();
        $context->setValidator(new ValidateTask());

        $controller = new $className(
            validator: $context,
            taskServices: $taskServices
        );

        return $controller;
    }
}
