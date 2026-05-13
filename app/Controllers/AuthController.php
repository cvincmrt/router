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
            $username = trim($_POST["username"] ?? "");
            $password = trim($_POST["password"] ?? "");

            $user = $this->userRepo->findByUsername($username);

            if(!$user || !$user->passwordVerify($password)){
                $_SESSION["flash_error"] = "Nespravne meno alebo heslo";
                
                header("Location:/router/public/login");
                exit();
            }

            $_SESSION["user_id"] = $user->getId();
            $_SESSION["username"] = $user->getUsername();
            $_SESSION["role"] = $user->getRole();
            

            if($user->getRole() === "admin"){
                header("Location:/router/public/admin");
            }else{
                header("Location:/router/public/dashboard");
            }        
            exit();      
        }

        include __DIR__ . "/../../views/login.php";
    }    

    public function logout() :void
    {
        session_destroy();
        header("Location:/router/public/");
        exit();
    }

    public function register()
    {
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $username = trim($_POST["username"] ?? "");
            $password = trim($_POST["password"] ?? "");

            if($this->userRepo->findByUsername($username)){
                $_SESSION["flash_error"] = "Uzivatelske meno uz existuje";
                header("Location:/router/public/register");
                exit();
            }

            if(mb_strlen($username) < 3 || mb_strlen($password) < 6){
                $_SESSION["flash_error"] = "Uzivatelske meno musi mat aspon 3 znaky a heslo 6 znakov";
                header("Location:/router/public/register");
                exit();
            }

            $newUser = new User(username:$username, password:$password, isAlreadyHashed:false);

            if($this->userRepo->save($newUser)){
                $_SESSION["flash_success"] = "Registracia prebehla uspesne mozes sa prihlasit :-)";
                header("Location:/router/public/login");
                exit();
            }

        }

        include __DIR__ ."/../../views/register.php";
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