<?php

declare(strict_types=1);

namespace App\Views;

use App\Entity\IEntity;
use App\Entity\TaskEntity;

class TaskView extends BaseView
{
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
