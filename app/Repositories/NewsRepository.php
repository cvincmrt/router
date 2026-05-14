<?php

namespace App\Repositories;

use PDO;
use PDOException;
use App\Models\News;

class NewsRepository extends BaseRepository
{
   
    public function save(News $news) :bool
    {
        try{
            $sql = "INSERT INTO news (title,content,image_path) VALUES (:title, :content, :image_path)";
            $stmt = $this->db->prepare($sql);

            $result = $stmt->execute([
                ":title" => $news->getTitle(),
                ":content" => $news->getContent(),
                ":image_path" => $news->getImagePath()
            ]);

            if($result){
                $news->setId((int)$this->db->lastInsertId());
            }

            return $result;
        }
        catch(PDOException $e){
            return false;
        }
    } 

    public function getAll() :?array
    {
        try{
            $news = [];    
            $sql = "SELECT * FROM news";

            $stmt = $this->db->query($sql);

            while($row = $stmt->fetch()){
                $novelty = null;

                $novelty = new News($row["title"], $row["content"], $row["image_path"]);
                $novelty->setId((int)$row["id"]);
                $novelty->setCreatedAt($row["created_at"]);

                $news[] = $novelty;
            }
            return $news;
        }
        catch(PDOException $e){
            return null;
        }

    }
}