<?php

require_once __DIR__. "/../vendor/autoload.php";

session_start();

use App\Core\Database;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Controllers\AuthController;


$db = new Database();

$pdo = $db->getConnection();

$userRepo = new UserRepository($pdo);

$authController = new AuthController($userRepo);


