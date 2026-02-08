<?php

declare(strict_types=1);

namespace App\DB;

use Exception;
use Medoo\Medoo;
use PDO;

/**
 * DataBaseConnectios class
 */
class DataBaseConnectios
{
    /**
     */
    private string $type = 'mysql';
    private string $servername = '';
    private string $username = '';
    private string $password = '';
    private string $dbname = '';

    /**
     */
    private ?Medoo $connection = null;

    /**
     */
    private static ?self $instance = null;

    /**
     * getInstance
     *
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * getConnection
     *
     */
    public function getConnection(): Medoo
    {
        if ($this->connection === null) {
            $this->connection();
        }

        return $this->connection;
    }

    /**
     * connection
     *
     */
    private function connection(): void
    {
        if (!$this->servername) {
            throw new Exception('Servername is required');
        }

        if (!$this->username) {
            throw new Exception('Username is required');
        }

        if (!$this->dbname) {
            throw new Exception('Servername is dbname');
        }

        // $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        $this->connection = new Medoo([
            'type' => $this->type,
            'host' => $this->servername,
            'database' => $this->dbname,
            'username' => $this->username,
            'password' => $this->password,
        ]);
    }

    /**
     * __construct
     *
     * @return void
     */
    private function __construct()
    {
        $this->servername = $_ENV['DB_HOST'];
        $this->username = $_ENV['DB_LOGIN'];
        $this->password = $_ENV['DB_PASS'];
        $this->dbname = $_ENV['DB_NAME'];
    }

    /**
     * __clone
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * __wakeup
     *
     */
    public function __wakeup(): void
    {
        throw new Exception("Cannot unserialize singleton");
    }
}
