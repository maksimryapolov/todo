<?php

declare(strict_types=1);

namespace App\Repository;

use App\DB\DataBaseConnectios;
use App\Entity\TaskEntity;
use Medoo\Medoo;

class TaskRepository
{
    private Medoo $connection;

    public function __construct(
        private DataBaseConnectios $db
    ) {
        $this->connection = $this->db->getConnection();
    }

    public function save(TaskEntity $taskEntity): TaskEntity
    {
        $this->connection->insert("task", [
            "title" => $taskEntity->name,
            "description" => $taskEntity->description,
            "deadline" => $taskEntity->deadline,
            'status_id' => $taskEntity->status->getId()
        ]);

        $taskEntity->setId((int)$this->connection->id());
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
        $data = $this->connection->select('task',
            [
                '[>]status' => ['status_id' => 'id'] // LEFT JOIN
            ],
            [
                'task.id',
                'task.title',
                'task.description',
                'task.created_at',
                'task.deadline',
                'task.status_id(statusId)'
            ],
            [
                'LIMIT' => [$offset, $limit],
                'ORDER' => ["task.$sort" => $sortBy]
            ]
        );

        return TaskEntity::initFromArray((array)$data);
    }
}
