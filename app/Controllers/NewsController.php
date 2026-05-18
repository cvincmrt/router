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
    {
         if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
            header("Location:/router/public/login");
            exit();
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $title = trim($_POST["title"]) ?? "";
            $content = trim($_POST["content"]) ?? "";
            $image_path = null;

            $news = new News($title, $content, $image_path);

            $result = $this->newsRepo->save($news);

            if($result){
                $_SESSION["flash_success"] = "novinka bola pridana";
                header("Location:/router/public/admin/news");
                exit();
            }

            $_SESSION["flash_error"] = "novinka sa nepridala";
                header("Location:/router/public/admin/news");
                exit();
        }

        include __DIR__ . "/../../views/admin/news_create.php";
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