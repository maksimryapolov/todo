<?php
namespace App\DB;

use PDO;
use Exception;
/**
 * DataBaseConnectios class
 */
class  DataBaseConnectios
{
    // TODO: Вынести в .env
    /**
     * @var string
     */
    private string $servername = 'localhost';
    private string $username = 'root';
    private string $password = '';
    private string $dbname = 'tortuga';

    /**
     * @var PDO|null
     */
    private ?PDO $connection = null;

    /**
     * @var self|null
     */
    private static ?self $instance = null;

    /**
     * getInstance
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if(self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * getConnection
     *
     * @return PDO
     */
    public function getConnection(): PDO
    {
        if($this->connection == null) {
            $this->connection();
        }

        return $this->connection;
    }

    /**
     * connection
     *
     * @return void
     */
    private function connection()
    {
        $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
    }

    /**
     * __construct
     *
     * @return void
     */
    private function __construct()
    {}

    /**
     * __clone
     *
     * @return void
     */
    private function __clone()
    {}

    /**
     * __wakeup
     *
     * @return void
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}
