<?php

namespace App\Controllers;

use App\Repositories\NewsRepository;

class HomeController
{
    private NewsRepository $newsRepo;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepo = $newsRepo;
    }

    public function index()
    {
        $newsList = $this->newsRepo->getAll();  

        include __DIR__ ."/../../views/home.php";
    }
}