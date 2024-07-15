<?php
include_once 'env.php';

class Database
{
    private $host = "localhost";
    private $db_name = "crud";
    private $port = 3307;
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";port=" . $this->port, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection Error:" . $exception->getMessage();
        }
        return $this->conn;
    }
}
