<?php

declare(strict_types=1);

namespace App\Repository;

use App\DB\DataBaseConnectios;
use App\Entity\TaskEntity;

class TaskRepository extends BaseRepository
{
    private const TABLE_NAME = 'task';

    /**
     * @param DataBaseConnectios $db
     */
    public function __construct(
        private DataBaseConnectios $db
    ) {
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return self::TABLE_NAME;
    }

    /**
     * @param TaskEntity $taskEntity
     * @return TaskEntity
     */
    public function save(TaskEntity $taskEntity): TaskEntity
    {
        $connection = $this->db->getConnection();
        $connection->insert('task', [
            'name' => $taskEntity->name,
            'description' => $taskEntity->description,
            'created_at' => $taskEntity->date,
            'status' => $taskEntity->status->getId(),
        ]);

        $taskEntity->setId((int)$connection->id());
        return $taskEntity;
    }

    /**
     * @return array<string>
     */
    public static function getSelectedParams(): array
    {
        $params = [
            'description',
            'created_at',
            'status'
        ];

        return array_merge($params, parent::getSelectedParams());
    }

    public function getTasks()
    {
        $connection = $this->db->getConnection();
        $params = self::getSelectedParams();

        $data = $connection->select(
            'task',
            $params
        );

        echo'<pre>';var_dump($data);echo'</pre>';
        die;
    }
}
