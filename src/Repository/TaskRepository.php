<?php
namespace App\Repository;

use App\Entity\TaskEntity;
use App\DB\DataBaseConnectios;

class TaskRepository
{
    public function __construct(
        private DataBaseConnectios $db
    )
    {}

    public function save(TaskEntity $taskEntity): TaskEntity
    {
        $connection = $this->db->getConnection();
        $connection->insert("task", [
            "name" => $taskEntity->name,
            "description" => $taskEntity->description,
            "created_at" => $taskEntity->date,
            'status' => $taskEntity->status->getId()
        ]);

        $taskEntity->setId($connection->id());
        return $taskEntity;
    }
}