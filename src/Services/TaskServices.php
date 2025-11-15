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

    public function create(TaskDTO $taskDTO): TaskEntity
    {
        // StatusService → StatusEntity → TaskEntity → TaskRepository → БД
        // пока убрать статус из DTO если получпть статусы из ответа то получать соотв статус
        $statusEntity = $this->statusService->getStatusNew();

        $taskEntity = TaskEntity::createNew(
            name: $taskDTO->name,
            description: $taskDTO->description,
            date: $taskDTO->date,
            status: $statusEntity
        );

        return $this->taskRepository->save($taskEntity); // Репозиторий должен возвращать сущность с установленным ID
    }
}
