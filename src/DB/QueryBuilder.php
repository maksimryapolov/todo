<?php

namespace App\DB;

class QueryBuilder
{
    /**
     * @var string
     */
    private string $table;
    private array $selectParams = [];
    private array $whereParams = [];
    private array $whereValues = [];

    /**
     * @param DataBaseConnectios $dataBaseConnectios
     */
    public function __construct(
        public DataBaseConnectios $dataBaseConnectios,
    )
    {}

    public function where(array $params = []): QueryBuilder
    {
        if(!empty($params)) {
            $this->whereParams = array_keys($params);
            $this->whereValues = $params;
        }

        return $this;
    }

    /**
     * @param string $table
     * @return QueryBuilder
     */
    public function table(string $table): QueryBuilder
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param array $params
     * @return QueryBuilder
     */
    public function select(array $params): QueryBuilder
    {
        $this->selectParams = $params ?? ['*'];
        return $this;
    }

    /**
     *
     * @return QueryBuilder
     */
    public function get(): QueryBuilder
    {
        $query = 'SELECT * from ' . $this->table;
        echo'<pre>';var_dump($this->whereParams, $this->whereValues);echo'</pre>';
        die;
        if($this->checkWhereParams()) {
            $query . 'WHERE ';
        }

        return $this;
    }

    private function checkWhereParams()
    {
        return $this->whereParams && !empty($this->whereParams);
    }
}
