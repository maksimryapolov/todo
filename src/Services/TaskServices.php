<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TaskDTO;
use App\Entity\TaskEntity;
use App\Repository\TaskRepository;

class TaskServices
{
    /**
     * @param TaskRepository $taskRepository
     * @param StatusService $statusService
     */
    public function __construct(
        private TaskRepository $taskRepository,
        private StatusService $statusService
    ) {
    }

    /**
     * @param TaskDTO $taskDTO
     * @return TaskEntity
     */
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

        $taskEntity = $this->taskRepository->save($taskEntity); // Репозиторий должен возвращать сущность с установленным ID
        return $taskEntity;
    }

    /**
     * @return array<TaskEntity>
     */
    public function getTasks(): array
    {
        $data = [];

        $this->taskRepository->getTasks();

        return $data;
    }
}
