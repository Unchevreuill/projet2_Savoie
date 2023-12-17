<?php

class DbConfig
{
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DATABASE = 'ecom2_project';

    private $pdo;

    private static $instance;

    public function __construct()
    {
        $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DATABASE . ";charset=UTF8";

        try {
            $this->pdo = new PDO($dsn, self::USERNAME, self::PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            var_dump($this->pdo);
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}

?>
