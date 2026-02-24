<?php

declare(strict_types=1);

namespace App\App;

use App\Controllers\Helpers\TaskControllerDispatcher;
use App\Controllers\interfaces\ControllerInterface;
use App\Controllers\TaskController;
use App\DB\DataBaseConnectios;
use App\Repository\StatusRepository;
use App\Repository\TaskRepository;
use App\Services\StatusService;
use App\Services\TaskServices;
use App\Validators\ValidateContext;
use App\Validators\ValidateTask;

class Container
{
    /**
     * @param string $className
     * @return ControllerInterface
     */
    public function get(string $className)
    {
        $controller = match($className) {
            TaskController::class => $this->initTaskController()
        };

        return $controller;
    }

    /**
     * @return ControllerInterface
     */
    private function initTaskController()
    {
        $db = DataBaseConnectios::getInstance();
        // $queryBuilder = new \App\DB\QueryBuilder\QueryBuilder($db);

        $statusRepository = new StatusRepository($db);
        $statusService = new StatusService($statusRepository);

        $taskepository = new TaskRepository($db);
        $taskServices = new TaskServices($taskepository, $statusService);

        $context = new ValidateContext();
        $context->setValidator(new ValidateTask());

        $dispatcher = new TaskControllerDispatcher(
            statusRepository: $statusRepository,
            statusService: $statusService,
            taskepository: $taskepository,
            taskServices: $taskServices,
            context: $context
        );

        $dispatcher->initController();
        return $dispatcher->getController();
    }
}
