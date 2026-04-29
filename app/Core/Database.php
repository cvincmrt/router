<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private string $host = "localhost";
    private string $dbname = "db_users";
    private string $user = "root";
    private string $password = "";
    private string $charset = "utf8mb4";
    private ?PDO $conn = null;

    public function getConnection() :?PDO
    {
        if($this->conn !== null){
            return $this->conn;
        }

        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";

        try{
            $this->conn = new PDO($dsn,$this->user,$this->password);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
           die("Connection error:".$e->getMessage());
        }

        return $this->conn;
    }
}