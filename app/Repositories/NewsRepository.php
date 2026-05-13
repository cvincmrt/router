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
}