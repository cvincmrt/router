<?php

require_once __DIR__. "/../vendor/autoload.php";

session_start();

use App\Core\Database;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Controllers\AuthController;
use App\Core\Router;


$db = new Database();

$pdo = $db->getConnection();

$userRepo = new UserRepository($pdo);

$authController = new AuthController($userRepo);

$router = new Router();

$router->add("/login", $authController, "login");
$router->add("/register", $authController, "register");
$router->add("/logout", $authController, "logout");

$router->resolve();


