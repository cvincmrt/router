<?php

require_once __DIR__. "/../vendor/autoload.php";

session_start();

use App\Core\Database;
use App\Repositories\UserRepository;


$db = new Database();

$pdo = $db->getConnection();

$userRepo = new UserRepository($pdo);

var_dump($userRepo->findByUsername("miro"));
