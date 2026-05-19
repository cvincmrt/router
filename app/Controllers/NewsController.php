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

            /*************** presunutie obrazka z docasneho adresara ku mne do public/uploads */

            if(isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK){
                $uploadDir = __DIR__ ."/../../public/uploads/"; //cesta k adresaru kde budem ukladat obrazky

                $fileName = time()."_".basename($_FILES["image"]["name"]); //vytvorim unikatny nazov obrazka
                $targetPath = $uploadDir.$fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $image_path = '/uploads/' . $fileName;
                }
            }

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

    public function delete()
    {
        if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
            header("Location:/router/public/login");
            exit();
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

            if($id <= 0){
                $_SESSION["flash_error"] = "neexistuje id novinky";
                header("Location:/router/public/admin/news");
                exit();
            }
/**************************************** zmazanie obrazka z uploads *********************************/
            $novelty = $this->newsRepo->getById($id);    

            if($novelty){
                $imagePath = $novelty->getImagePath();

                if(!empty($imagePath)){
                    $fullPath = __DIR__ . "/../../public".$imagePath;

                    if(file_exists($fullPath)){
                        unlink($fullPath);
                    }
                }
            }

            $result = $this->newsRepo->delete(($id));
                
            if(!$result){
                $_SESSION["flash_error"] = "novinku sa nepodarilo zmazat";
            }else{
                $_SESSION["flash_success"] = "novinka bola zmazana";
            }
           
            header("Location:/router/public/admin/news");
            exit();       
        }
    }

    public function edit()
    {
        if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin"){
            header("Location:/router/public/login");
            exit();
        }

/******************* POST časť *********************************/

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

            if($id <= 0){
                $_SESSION["flash_error"] = "neplatné id novinky";
                header("Location:/router/public/admin/news");
                exit(); 
            }

            $novelty = $this->newsRepo->getById($id);
            
            if(!$novelty){
                $_SESSION["flash_error"] = "novinka sa nenasla";
                header("Location:/router/public/admin/news");
                exit(); 
            }
            
            $image_path = $novelty->getImagePath();
            
            $title = trim($_POST["title"]) ?? "";
            $content = trim($_POST["content"]) ?? "";
            
            if(isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK){
                $uploadDir = __DIR__ ."/../../public/uploads/"; //cesta k adresaru kde budem ukladat obrazky

                $fileName = time()."_".basename($_FILES["image"]["name"]); //vytvorim unikatny nazov obrazka
                $targetPath = $uploadDir.$fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $image_path = '/uploads/' . $fileName;
                }
            }

            $novelty->setTitle($title);
            $novelty->setContent($content);
            $novelty->setImagePath($image_path);

            $result = $this->newsRepo->update($novelty);

            if($result){
                $_SESSION["flash_success"] = "novinka bola uspešne zmenená";
            }else{
                $_SESSION["flash_error"] = "novinku sa nepodarilo uložiť";
            }

            header("Location:/router/public/admin/news");
            exit(); 
        }

/******************* GET časť *********************************/

        $id = isset($_GET["id"]) ?(int)$_GET["id"] : 0;

        if($id <= 0){
            $_SESSION["flash_error"] = "neexistuje id novinky";
            header("Location:/router/public/admin/news");
            exit();
        }
        
        $novelty = $this->newsRepo->getById($id);
       
        include __DIR__ ."/../../views/admin/news_edit.php";
    }
}