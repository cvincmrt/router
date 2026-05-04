<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Models\User;

class AuthController
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login()
    {
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $username = $_POST["username"] ?? "";
            $password = $_POST["password"] ?? "";

            $user = $this->userRepo->findByUsername($username);

            if(!$user || !$user->passwordVerify($password)){
                $_SESSION["flash_error"] = "Nespravne meno alebo heslo";
                
                header("Location:/router/public/login");
                exit();
            }

            $_SESSION["user_id"] = $user->getId();
            $_SESSION["username"] = $user->getUsername();

            header("Location:/router/public/dashboard");
            exit();      
        }

        include __DIR__ . "/../../views/login.php";
    }    

    public function logout() :void
    {
        session_destroy();
        header("Location:/router/public/login");
        exit();
    }

    public function register(string $username, string $password) :string
    {
        if($this->userRepo->findByUsername($username)){
            return "Chyba: Uzivatel s danym menom uz existuje";
        }

        $newUser = new User(username:$username, password:$password, isAlreadyHashed:false);

        if($this->userRepo->save($newUser)){
            $_SESSION["flash_success"] = "Registracia prebehla uspesne";
            header("Location:login.php");
            exit();
        }

        return "Nastala chyba pri registracii!!!";
    }

    public function dashboard()
    {
        if(!isset($_SESSION["user_id"])){
             $_SESSION["flash_error"] = "Musis sa najskor prihlasit";
            header("Location:/router/public/login");
            exit();
        }
        
        include __DIR__ . "/../../views/dashboard.php";
    }
}