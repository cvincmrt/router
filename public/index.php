<?php




require_once __DIR__. "/../vendor/autoload.php";

session_start();

use App\Core\Database;

use App\Models\User;

use App\Repositories\UserRepository;
use App\Repositories\NewsRepository;

use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Controllers\HomeController;
use App\Controllers\NewsController;

use App\Core\Router;


$db = new Database();

$pdo = $db->getConnection();

$userRepo = new UserRepository($pdo);
$newsRepo = new NewsRepository($pdo);

$authController = new AuthController($userRepo);
$newsController = new NewsController($newsRepo);
$homeController = new HomeController();

$adminController = new AdminController();


$router = new Router();

$router->add("/", $homeController, "index");
$router->add("/login", $authController, "login");
$router->add("/register", $authController, "register");
$router->add("/dashboard", $authController, "dashboard");
$router->add("/logout", $authController, "logout");
$router->add("/admin", $adminController, "adminDashboard");
$router->add("/admin/news", $newsController, "adminIndex");


$router->resolve();


