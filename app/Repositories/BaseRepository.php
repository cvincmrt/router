<?php

namespace App\Repositories;

use PDO;

abstract class BaseRepository
{
    protected PDO $db;

    public function __construct(PDO $pdo){
        $this->db = $pdo;
    }
}