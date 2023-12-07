<?php

class DbConfig
{
    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = '';
    private $_database = 'ecom2_project';
    private $_dsn = '';
    protected $connection;

    public function __construct()
    {
        $this->_dsn = "mysql:host=$this->_host;dbname=$this->_database;charset=UTF8";

        try {
            $this->connection = new PDO(
                $this->_dsn,
                $this->_username,
                $this->_password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Database connection error: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
?>
