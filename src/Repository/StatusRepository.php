<?php

namespace App\Repository;

use App\DB\QueryBuilder;

class StatusRepository
{
    public function __construct(
        private QueryBuilder $queryBuilder
    )
    {}

    public function getStatusByCode(string $status)
    {
        $this->queryBuilder
            ->table('status')
            ->where([
                'code' => $status
            ])
            ->get();
    }
}
