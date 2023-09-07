<?php
// On spécifie dans quel namespace se trouve ce modèle
namespace App\Models;

// on spécifie les namespaces requis dans notre code
use App\Utility\DataBase;
use \PDO;

// Ce modèle est la représentation "code" de notre table posts
// elle aura donc autant de propriétés qu'il y'a de champs dans la table
// ça nous permettra de manipuler des objets identiques à une entrée de bdd grâce à PDO::FETCH_CLASS
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


    // méthode pour récupérer tous les articles, il est possible de spécifier une limite
    public static function getPosts()
    {
        // connexion pdo avec le pattern singleton
        $pdo = DataBase::connectPDO();
        // s'il y'a un param limit
        $query = $pdo->prepare('SELECT * FROM hiking');


        $query->execute();
        // on fetchAll avec l'option FETCH_CLASS afin d'obtenir un tableau d'objet de type PostModel. 
        // On pourra ensuite manipuler les propriétés grâce au getters / setters
        // ne pas oublier de spécifier le namespace App\Models\PostModel !
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