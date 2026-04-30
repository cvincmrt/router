<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Models\User;

class UserRepository
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function findByUsername(string $username) :?User
    {
        try{
            $user = null;

            $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([":username" => $username]);
            
            if($row = $stmt->fetch()){
               $user = new User($row["username"], $row["password"], $row["role"], true);
               $user->setId((int)$row["id"]);
               $user->setCreatedAt($row["created_at"]);

               return $user;
            }
            return null;  
        }
        catch(PDOException $e)
        {
            return null;
        }       
    }
}