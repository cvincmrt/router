<?php

session_start();

require_once __DIR__. "/../vendor/autoload.php";

use App\Core\Database;
use App\Repositories\UserRepository;
use App\Controllers\AuthControllers;
use App\Core\Router;

$db = new Database();

$pdo = $db->getConnect();

$userRepo = new UserRepository($pdo);

$authController = new AuthControllers($userRepo);

$router = new Router();
$router->add("/login", $authController, "login");


$router->resolve();


