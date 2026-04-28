<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class AuthControllers
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo){
        $this->userRepo = $userRepo;
    }



    
}