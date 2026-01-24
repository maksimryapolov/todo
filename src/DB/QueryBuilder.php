<?php

declare(strict_types=1);

namespace App\DB;

use PDO;

class QueryBuilder
{
    /**
     */
    private string $table;
    private array $selectParams = [];
    private array $whereParams = [];
    private array $whereValues = [];

    /**
     */
    public function __construct(
        public DataBaseConnectios $dataBaseConnectios,
    ) {
    }

    public function where(array $params = []): QueryBuilder
    {
        if (!empty($params)) {
            $this->whereParams = array_keys($params);
            $this->whereValues = $params;
        }

        return $this;
    }

    /**
     */
    public function table(string $table): QueryBuilder
    {
        $this->table = $table;
        return $this;
    }

    /**
     */
    public function select(array $params): QueryBuilder
    {
        $this->selectParams = $params ?? ['*'];
        return $this;
    }

    /**
     *
     */
    public function get(): QueryBuilder
    {
        $query = 'SELECT * from ' . $this->table;


        if ($this->checkWhereParams()) {
            $query .= ' WHERE ';
        }

        $result = array_map(
            static fn ($item) => $item . " = :" . $item,
            $this->whereParams
        );

        $query .= implode(' AND ', $result);
        $connection = $this->dataBaseConnectios->getConnection();

        $stmt = $connection->prepare($query);
        $stmt->execute($this->whereValues);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function checkWhereParams()
    {
        return $this->whereParams && !empty($this->whereParams);
    }
}
