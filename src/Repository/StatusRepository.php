<?php

namespace App\Repository;

use App\DB\DataBaseConnectios;
use App\Entity\StatusEntity;
use InvalidArgumentException;

class StatusRepository
{
    public function __construct(
        private DataBaseConnectios $db
    )
    {}

    public function findStatusByCode(string $status): StatusEntity
    {
        $result = [];

        if(!$status) {
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
