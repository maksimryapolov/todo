<?php

declare(strict_types=1);

namespace App\Views;

use App\Entity\IEntity;
use App\Entity\TaskEntity;

class TaskView extends BaseView
{
    /**
     * @param IEntity $task
     * @return array{
     *     description: string
     *     createdAt: string
     * }
     */
    protected function getEntitySpecificData(IEntity $task): array
    {
        if ($task instanceof TaskEntity) {
            return [
                'description' => $task->getDescription(),
                'createdAt' => $task->createdAtToString(),
            ];
        }

        return [];
    }

    /**
     * @param array $tasks
     * @return array
     */
    public static function getViewList(array $tasks): array
    {
        return array_map(static fn($task) => self::getItem($task), $tasks);
    }

    /**
     * @param TaskEntity $task
     * @return array<string, string|int>
     */
    public static function getItem(TaskEntity $task): array
    {
        return [
            'id' => $task->getId(),
            'name' => $task->getName(),
            'slug' => $task->getCode(),
            'description' => $task->getDescription(),
            'createdAt' => $task->createdAtToString(),
        ];
    }
}
