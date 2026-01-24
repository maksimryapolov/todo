<?php

declare(strict_types=1);

namespace App\Repository;

use App\DB\DataBaseConnectios;
use App\Entity\TaskEntity;

class TaskRepository
{
    public function __construct(
        private DataBaseConnectios $db
    ) {
    }

    public function save(TaskEntity $taskEntity): TaskEntity
    {
        $connection = $this->db->getConnection();
        $connection->insert("task", [
            "name" => $taskEntity->name,
            "description" => $taskEntity->description,
            "created_at" => $taskEntity->date,
            'status' => $taskEntity->status->getId(),
        ]);

        $taskEntity->setId((int)$connection->id());
        return $taskEntity;
    }
}
