<?php
namespace App\Models;

use App\Utility\DataBase;
use \PDO;

class HikingModel
{
    private $id;
    private $image;
    private $title;
    private $descritpion;
    private $level;
    private $ascent;
    private $descent;
    private $duration;
    private $length;
    private $position;
    private $user_id;


    public static function getPosts(int $limit = null): array
    {
        // connexion pdo pattern singleton
        $pdo = DataBase::connectPDO();
        $query = $pdo->prepare('SELECT * FROM hiking');
        $query->execute();
        $posts = $query->fetchAll(PDO::FETCH_CLASS, 'App\Models\HikingModel');
        return $posts;
    }

public static function getHikingById(int $id): ?HikingModel
    
    {
        $pdo = DataBase::connectPDO();
        $query = $pdo->prepare('SELECT * FROM hiking WHERE id=:id');
        $query->bindParam(':id',$id);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Models\HikingModel');
        
        $post = $query->fetch();
        if(!$post){
         $post = null;
        }
        return $post;
    }
    
    public function insertHiking(): bool
    {
        $pdo = DataBase::connectPDO();
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO `hiking`(`image`, `title`, `description`, `level`, `ascent`, `descent`, `duration`, `length`,`position`, `user_id`) 
        VALUES (:image, :title, :description, :level, :ascent, :descent, :duration, :length, :position, :user_id)";
    
        $params = [
            
            'image' => $this->image,
            'title' => $this->title,
            'description' => $this->description,
            'level' => $this->level,
            'ascent' => $this->ascent,
            'descent' => $this->descent,
            'duration' => $this->duration,
            'length' => $this->length,
            'position' => $this->position,
            'user_id' => $user_id
        ];
        $query = $pdo->prepare($sql);
        $queryStatus = $query->execute($params);
        return $queryStatus;
    }
    
    public function updateHiking(): bool
    {
        $pdo = DataBase::connectPDO();
        $user_id = $_SESSION['user_id'];
        $sql = "UPDATE `hiking` SET `image` = :image, `title` = :title, `description` = :description, `level` = :level,
        `ascent` = :ascent, `descent` = :descent, `duration` = :duration, `length` = :length,`position` = :position, `user_id` = :user_id 
        WHERE `id` = :id";
        
        $params = [
            'id' => $this->id,
            'image' => $this->image,
            'title' => $this->title,
            'description' => $this->description,
            'level' => $this->level,
            'ascent' => $this->ascent,
            'descent' => $this->descent,
            'duration' => $this->duration,
            'length' => $this->length,
            'position' => $this->position,
            'user_id' => $user_id
        ];
        
        $query = $pdo->prepare($sql);
        $queryStatus = $query->execute($params);
        return $queryStatus;
        
    }
    
     public static function deleteHiking(int $postId): bool
    {
        $pdo = DataBase::connectPDO();
        $sql = 'DELETE FROM `hiking` WHERE id = :id';
        $query = $pdo->prepare($sql);
        $query->bindParam('id', $postId, PDO::PARAM_INT);
        $queryStatus = $query->execute();
        return $queryStatus;
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

   public function setTitle($title)
   {
       $this->title = $title;
       
   }

   public function getDescription()
   {
       return $this->description;
   }

   public function setDescription($description)
   {
       $this->description = $description;
       
   }

   public function getLevel()
   {
       return $this->level;
   }

   public function setLevel($level)
   {
       $this->level = $level;

   }

   public function getAscent()
   {
       return $this->ascent;
   }

   public function setAscent($ascent)
   {
       $this->ascent = $ascent;
       
   }
   
    public function getDescent()
   {
       return $this->descent;
   }

   public function setDescent($descent)
   {
       $this->descent = $descent;
       
   }
   
    public function getDuration()
   {
       return $this->duration;
   }

   public function setDuration($duration)
   {
       $this->duration = $duration;
       
   }
   
    public function getLength()
   {
       return $this->length;
   }

   public function setLength($length)
   {
       $this->length = $length;
       
   }
   
    public function getPosition()
   {
       return $this->position;
   }

   public function setPosition($position)
   {
       $this->position = $position;
       
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