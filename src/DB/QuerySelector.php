<?php

namespace App\DB;

class QuerySelector
{
    /**
     * @var string
     */
    private string $table;

    /**
     * @param DataBaseConnectios $dataBaseConnectios
     */
    public function __construct(
        public DataBaseConnectios $dataBaseConnectios,
    )
    {}
}