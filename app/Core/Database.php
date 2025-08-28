<?php

namespace App\Core;

use Dotenv\Dotenv;
use Exception;
use PDO;
use PDOException;

class Database
{
    private $driver;
    private $host;
    private $database;
    private $username;
    private $password;
    private $port;
    private $charset;
    private $dsn;
    protected $conn = null;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
        $dotenv->required(['DB_DRIVER', 'DB_HOST', 'DB_DATABASE', 'DB_USER', 'DB_PASSWORD', 'DB_PORT', 'DB_CHARSET']);

        $this->driver = $_ENV['DB_DRIVER'];
        $this->host = $_ENV['DB_HOST'];
        $this->database = $_ENV['DB_DATABASE'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->port = $_ENV['DB_PORT'];
        $this->charset = $_ENV['DB_CHARSET'];
        $this->dsn = "{$this->driver}:host={$this->host};port={$this->port};dbname={$this->database};charset={$this->charset}";
    }

    public function connect()
    {
        try {
            if ($this->conn === null) {
                $this->conn = new PDO($this->dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            }
        } catch (PDOException  $e) {
            throw new Exception("Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage(), true);
        }
        echo "Connection successfully.";
        return $this->conn;
    }

    public function close()
    {
        if ($this->conn !== null) {
            $this->conn = null;
        }
    }
}
