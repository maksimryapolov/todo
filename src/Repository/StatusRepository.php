<?php

declare(strict_types=1);

namespace App\Repository;

use App\DB\DataBaseConnectios;
use App\Entity\StatusEntity;
use InvalidArgumentException;

class StatusRepository
{
    public function __construct(
        private DataBaseConnectios $db
    ) {
    }

    public function findStatusByCode(string $status): StatusEntity
    {
        $result = [];

        if (!$status) {
            throw new InvalidArgumentException("Status is empty");
        }

        $result = $this->db->getConnection()->get(
            'status',
            '*',
            ['code' => $status]
        );

        return new StatusEntity(
            $result['id'],
            $result['code'],
            $result['name']
        );
    }

    /**
     * @param int $id
     *
     * @return StatusEntity
     */
    public function getById(int $id): StatusEntity
    {
        $result = $this->db->getConnection()->get(
            'status',
            '*',
            ['id' => $id]
        );

        return new StatusEntity(
            $result['id'],
            $result['code'],
            $result['name']
        );
    }
}
