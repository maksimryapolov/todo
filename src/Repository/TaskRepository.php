<?php

declare(strict_types=1);

namespace App\Repository;

use App\DB\DataBaseConnectios;
use App\Entity\TaskEntity;
use Medoo\Medoo;

class TaskRepository extends BaseRepository
{
    private Medoo $connection;

    private const TABLE_NAME = 'task';

    /**
     * @param DataBaseConnectios $db
     */
    public function __construct(
        private DataBaseConnectios $db
    ) {
        $this->connection = $this->db->getConnection();
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
