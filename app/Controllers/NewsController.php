<?php

namespace App\Controllers;

use App\Repositories\NewsRepository;
use App\Models\News;

class NewsController
{
    private NewsRepository $newsRepo;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepo = $newsRepo;
    }

    public function create()
    {/*
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $title = trim($_POST["title"]) ?? "";
            $content = trim($_POST["content"]) ?? "";
            $image_path = trim($_POST["image_path"]);

            $news = new News($title, $content, $image_path);

            if($news){
                $this->newsRepo->save($news);
                $_SESSION["flash_success"] = "novinka bola pridana";
                header(Location:/router/public/)
            }
        }

        include __DIR__ . "/../../views/addnews.php";*/
    }

    public function adminIndex()
    {
        if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
            header("Location:/router/public/login");
            exit();
        }
        
        $newsList = $this->newsRepo->getAll();
        
        include __DIR__ . "/../../views/admin/news_list.php";
    }
}