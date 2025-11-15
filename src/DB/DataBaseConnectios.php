<?php
namespace App\DB;

use PDO;
use Exception;
use Medoo\Medoo;

/**
 * DataBaseConnectios class
 */
class  DataBaseConnectios
{
    // TODO: Вынести в .env
    /**
     * @var string
     */
    private string $type = 'mysql';
    private string $servername = 'mysql';
    private string $username = 'root';
    private string $password = '1';
    private string $dbname = 'todo';

    /**
     * @var Medoo|null
     */
    private ?Medoo $connection = null;

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
     * @return Medoo
     */
    public function getConnection(): Medoo
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
        if(!$this->servername) {
            throw new Exception('Servername is required');
        }

        if(!$this->username) {
            throw new Exception('Username is required');
        }

        if(!$this->dbname) {
            throw new Exception('Servername is dbname');
        }

        // $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        $this->connection = new Medoo([
            'type' => $this->type,
            'host' => $this->servername,
            'database' => $this->dbname,
            'username' => $this->username,
            'password' => $this->password
        ]);
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
