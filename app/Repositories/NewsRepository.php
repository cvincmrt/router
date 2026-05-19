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

    public function delete(int $id) :bool
    {
        try{
            $sql = "DELETE FROM news WHERE id = :id";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ":id" => $id
            ]);
        }
        catch(PDOException $e){
            return false;
        }
    }

    public function getById(int $id) :?News
    {
        try{
            $sql = "SELECT * FROM news WHERE id = :id LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([":id" => $id]);

            $row = $stmt->fetch();

            if(!$row){
                return null;
            }    
            
            $novelty = new News($row["title"], $row["content"], $row["image_path"]);
            $novelty->setCreatedAt($row["created_at"]);
            $novelty->setId((int)$row["id"]);
            return $novelty;           
        }
        catch(PDOException $e){
            return null;
        }
    }

    public function update(News $novelty) :bool
    {
        try{
            $sql = "UPDATE news SET title = :title, content = :content, image_path = :image_path";
            $stmt = $this->db->prepare($sql);     
        
            return $stmt->execute([
                ":title" => $novelty->getTitle(),
                ":content" => $novelty->getContent(),
                ":image_path" => $novelty->getImagePath()
            ]);
        }
        catch(PDOException $e){
            return false;
        }
    }
}