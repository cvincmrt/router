<?php

namespace App\Models;

class News
{
    private ?int $id;

    private string $title;

    private string $content;

    private ?string $image_path;

    private string $created_at;

    public function __construct(string $title, string $content, ?string $image_path = null, string $created_at = "", ?int $id = null){
        $this->title = $title;
        $this->content = $content;
        $this->image_path = $image_path;
        $this->created_at = $created_at;
        $this->id = $id;
    }

    //***************************************************** getter **********************************************
    public function getId() :?int
    {
        return $this->id;
    }

    public function getTitle() :string
    {
        return $this->title;
    }

    public function getContent() :string
    {
        return $this->content;
    }

    public function getImagePath() :?string
    {
        return $this->image_path;
    }

    public function getCreatedAt() :string
    {
        return $this->created_at;
    }

    //****************************************************** setter ***********************************************
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setImagePath(string $image_path)
    {
        $this->image_path = $image_path;
    }

    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
    }

}