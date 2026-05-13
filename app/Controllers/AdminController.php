<?php

namespace App\Controllers;

class AdminController
{
    public function adminDashboard()
    {
        if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
            header("Location:/router/public/login");
            exit();
        }
        
        include __DIR__ . "/../../views/admin/dashboard.php";
    }
}