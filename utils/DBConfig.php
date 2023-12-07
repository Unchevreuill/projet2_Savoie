<?php

class DbConfig
{
    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = 'root';
    private $_database = 'ecom2_project';
    private $_dsn = '';
    protected $connexion;

    public function __construct()
    {
        if (!isset($this->_dsn)) {
            $this->_dsn = "mysql:host=$this->_host;dbname=$this->_database;charset=UTF8";
        }

        if (!isset($this->connexion)) {
            try {
                $this->connexion = new PDO(
                    $this->_dsn,
                    $this->_username,
                    $this->_password
                );
                $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception("Database connection error: " . $e->getMessage());
            }
        }
    }
}
?>
