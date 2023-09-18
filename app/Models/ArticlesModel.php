<?php

namespace App\Models;

use App\Utility\DataBase;
use \PDO;

class ArticlesModel 
{
    
    private $id;
    private $image; 
    private $title;
    private $date;
    private $description;
    private $user_id;
    
    
     public static function getArticles()
    {
        $pdo = DataBase::connectPDO();
        $query = $pdo->prepare('SELECT * FROM articles');
        
        $query ->execute();
        
        $articles = $query->fetchAll(PDO::FETCH_CLASS, 'App\Models\ArticlesModel');
        return $articles;
    }
    
    public static function getArticlesById($id): ?ArticlesModel
    
    {
        $pdo = DataBase::connectPDO();
        
        $query = $pdo->prepare('SELECT * FROM articles WHERE id=:id');
        
        $query->bindParam(':id',$id);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Models\ArticlesModel');
        
        $articles = $query->fetch();
        if(!$articles){
         $articles = null;
        }
        return $articles;
    }
    
    
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getImage()
   {
       return $this->image;
   }

   
   public function setImage($image)
   {
       $this->image = $image;
       
   }
    
    public function getTitle()
   {
       return $this->title;
   }

   /**
    * Set the value of date
    */
   public function setTitle($title)
   {
       $this->title = $title;
       
   }    
   
   public function getDate()
   {
       return $this->Date;
   }
   
   public function setDate($date)
   {
       $this->Date = $date;
   }
   
  public function getDescription()
   {
       return $this->description;
   }

   /**
    * Set the value of title
    */
   public function setDescription($description)
   {
       $this->description = $description;
       
   }
   
   public function getUserId()
   {
       return $this->user_id;
   }
   
   public function setUserId($user_id)
   {
       $this->user_id = $user_id;
   }
   
   
    
}

   