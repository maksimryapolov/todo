<?php

declare(strict_types=1);

namespace App\Repository;

use App\DB\DataBaseConnectios;
use App\Entity\StatusEntity;
use InvalidArgumentException;

class StatusRepository
{
    /**
     * @param DataBaseConnectios $db
     */
    public function __construct(
        private DataBaseConnectios $db
    ) {
    }

    /**
     * @param string $status
     * @return StatusEntity
     */
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
}
