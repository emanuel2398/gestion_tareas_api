<?php
namespace Config;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database
{
    private $pdo;

    public function __construct()
    {
        // Cargar el archivo .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $charset = $_ENV['DB_CHARSET'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error conectar Base de Datos: ' . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
