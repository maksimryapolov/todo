<?php

namespace App\App;

use App\DB\QueryBuilder;
use App\DB\DataBaseConnectios;
use App\Services\TaskServices;
use App\Validators\ValidateTask;
use App\Repository\TaskRepository;
use App\Repository\StatusRepository;
use App\Services\StatusService;

class Container
{
    public function get(
        string $className
    )
    {
        $db = DataBaseConnectios::getInstance();
        $queryBuilder = new QueryBuilder($db);

        $statusRepository = new StatusRepository($queryBuilder);
        $statusService = new StatusService($statusRepository);

        $taskepository = new TaskRepository();
        $taskServices = new TaskServices($taskepository, $statusService);



        $validator = new ValidateTask();

        $controller = new $className(
            validator: $validator,
            taskServices: $taskServices
        );

        return $controller;
    }
}
