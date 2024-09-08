<?php

namespace App\Config;
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database
{
    private $connection;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }

    public function getConnection(): ?PDO
    {
        $this->connection = null;

        try {
            $dsn = "mysql:host=" . $_ENV['DB_HOST'] .
                ";port=" . $_ENV['DB_PORT'] .
                ";dbname=" . $_ENV['DB_NAME'];

            $this->connection = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}