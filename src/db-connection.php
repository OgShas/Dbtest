<?php

class Database
{
    private $servername = 'mysql:host=localhost;dbname=mystudentsystem';
    private $username = "root";
    private $password = "root";

    private $conn;

    public function __construct()
    {
        $this->connect();
    }
    private function connect(): void
    {
        try {
            $this->conn = new PDO($this->servername, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }
    public function lastInsertID()
    {
        return $this->conn->lastInsertID();
    }
    public function closeConnection(): void
    {
        if ($this->conn) {
            $this->conn = null;
        }
    }
}
