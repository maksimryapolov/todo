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
            'status_id' => $taskEntity->getStatusId()
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
        // TODO: проверить пагинацию
        $data = $this->connection->select('task',
            [
                '[>]status' => ['status_id' => 'id'] // LEFT JOIN
            ],
            self::getSelectedParams(),
            [
                'LIMIT' => [$offset, $limit],
                'ORDER' => [self::getTableName() . '.' . $sort => $sortBy]
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
            self::getTableName() . '.title',
            self::getTableName() . '.description',
            self::getTableName() . '.created_at',
            self::getTableName() . '.deadline',
            self::getTableName() . '.status_id(statusId)',
        ];

        return array_merge($params, parent::getSelectedParams());
    }
}
