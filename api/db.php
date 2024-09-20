<?php
class DB
{
    private     $dsn =   'mysql:host=localhost; dbname=mockup';
    private     $dbuser =   'root';
    private     $dbpass =   '';
    protected   $conn;

    function __construct() {}
    protected function connect()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
