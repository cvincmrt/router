<?php

session_start();

require_once __DIR__."/../vendor/autoload.php";

use App\Core\Database;

$db = new Database();

$pdo = $db->getConnect();

var_dump($pdo);