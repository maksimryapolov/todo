<?php

namespace App\Services;

use App\DTO\TaskDTO;
use App\Entity\TaskEntity;
use App\Repository\TaskRepository;

class TaskServices
{
    public function __construct(
        private TaskRepository $taskRepository,
        private StatusService $statusService
    )
    {}

    public function create(TaskDTO $taskDTO)
    {
        echo'<pre>';var_dump($this->statusService->getNewStatus());echo'</pre>';

        $taskEntity = TaskEntity::createNew(
            name: $taskDTO->name,
            description: $taskDTO->description,
            date: $taskDTO->date,
            status: $taskDTO->status
        );

        echo'<pre>';var_dump(['test' => $taskEntity]);echo'</pre>';
        die;

        $taksId = $this->taskRepository->save($taskEntity);
        $taskEntity->setId($taksId);

        return $taskEntity->getId();
    }
}
