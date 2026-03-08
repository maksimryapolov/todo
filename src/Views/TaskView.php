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
}
