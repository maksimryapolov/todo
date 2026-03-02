<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TaskDTO;
use App\Entity\TaskEntity;
use App\Repository\TaskRepository;
use App\Entity\StatusEntity;

class TaskServices
{
    public function __construct(
        private TaskRepository $taskRepository,
        private StatusService $statusService
    ) {
    }

    public function create(TaskDTO $taskDTO): TaskEntity
    {
        // StatusService → StatusEntity → TaskEntity → TaskRepository → БД
        // пока убрать статус из DTO если получпть статусы из ответа то получать соотв статус
        $statusEntity = $this->statusService->getStatusNew();

        $taskEntity = TaskEntity::createNew(
            name: $taskDTO->name,
            description: $taskDTO->description,
            deadline: $taskDTO->deadline,
            status: $statusEntity,
            statusId: $statusEntity->getId()
        );

        $taskEntity = $this->taskRepository->save($taskEntity); // Репозиторий должен возвращать сущность с установленным ID
        return $taskEntity;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $sort
     * @param string $sortBy
     *
     * @return array<TaskEntity>
     */
    public function getList(int $limit = 10, int $offset = 0, string $sort = 'created_at', string $sortBy = 'ASC'): array
    {
        $taskEntities = $this->taskRepository->getList($limit, $offset, $sort, $sortBy);
        $statusesIds = $this->getUniqStatusesIdsFromTaskEntity($taskEntities);
        $statusesEntity = $this->statusService->getStatusByIds($statusesIds);
        $this->hydrateTasksWithStatuses($taskEntities, $statusesEntity);

        return $taskEntities;
    }

    /**
     * @param array<TaskEntity> $taskEntities
     *
     * @return array
     */
    private function getUniqStatusesIdsFromTaskEntity(array $taskEntities): array
    {
        return array_unique(
            array_map(
                static fn(TaskEntity $task) => $task->getStatusId(), $taskEntities
            )
        );
    }

    /**
     * @param array<TaskEntity> $taskEntities
     * @param array<StatusEntity> $statusesEntity
     *
     * @return void
     */
    private function hydrateTasksWithStatuses(array $taskEntities, array $statusesEntity): void
    {
        foreach($taskEntities as $taskEntity) {
            $taskEntity->setStatus($statusesEntity[$taskEntity->getStatusId()]);
        }
    }
}
