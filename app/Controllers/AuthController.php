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

    public function login(string $username, string $password) :string
    {
        $user = $this->userRepo->findByUsername($username);

        if(!$user || !$user->passwordVerify($password)){
           return "Nespravne meno alebo heslo"; 
        }

        $_SESSION["user_id"] = $user->getId();
        $_SESSION["username"] = $user->getUsername();

        return "Uspesne prihlaseny! Vitaj, ".$user->getUsername();

    }

    public function logout() :void
    {
        session_destroy();
        header("Location:login.php");
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
}