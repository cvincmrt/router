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

    public function show()
    {
        $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
        
        if($id <= 0){
            $_SESSION["flash_error"] = "neexistuje id novinky";
            header("Location:/router/public/");
            exit();
        }

        $novelty = $this->newsRepo->getById($id);

        if(!$novelty){
            $_SESSION["flash_error"] = "nenasiel sa detail o novinke";
            header("Location:/router/public/");
            exit();
        }

        include __DIR__ . "/../../views/news/detail.php";
    }
}