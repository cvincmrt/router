<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class AuthController
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(string $username, string $password)
    {
        $user = $this->userRepo->findByUsername($username);

        if(!$user || !$user->passwordVerify($password)){
           echo "Nespravne meno alebo heslo"; 
        }

        $_SESSION["user_id"] = $user->getId();

        return "Uspesne prihlaseny! Vitaj, ".$user->getUsername();

    }
}