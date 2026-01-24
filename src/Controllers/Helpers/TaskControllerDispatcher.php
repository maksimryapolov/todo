<?php

declare(strict_types=1);

namespace App\Controllers\Helpers;

use App\Controllers\TaskController;
use App\Repository\StatusRepository;
use App\Repository\TaskRepository;
use App\Services\StatusService;
use App\Services\TaskServices;
use App\Validators\ValidateContext;

class TaskControllerDispatcher extends BaseControllerDispatcher
{
    public function __construct(
        private StatusRepository $statusRepository,
        private StatusService $statusService,
        private TaskRepository $taskepository,
        private TaskServices $taskServices,
        private ValidateContext $context
    ) {
    }

    public function initController(): void
    {
        $this->controller = new TaskController(
            validator: $this->context,
            taskServices: $this->taskServices
        );
    }
}
