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
    // TODO: Вынести в .env

    /**
     * @var string
     */
    private string $type = 'mysql';

    /**
     * @var string
     */
    private string $servername = 'mysql';

    /**
     * @var string
     */
    private string $username = 'root';

    /**
     * @var string
     */
    private string $password = '1';

    /**
     * @var string
     */
    private string $dbname = 'todo';

    /**
     * Undocumented variable
     *
     * @var Medoo|null
     */
    private ?Medoo $connection = null;

    /**
     * @var self|null
    */
    private static ?self $instance = null;

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return Medoo
     */
    public function getConnection(): Medoo
    {
        if ($this->connection === null) {
            $this->connection();
        }

        return $this->connection;
    }

    /**
     * @return void
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
     * @return void
     */
    public function __wakeup(): void
    {
        throw new Exception("Cannot unserialize singleton");
    }
}
