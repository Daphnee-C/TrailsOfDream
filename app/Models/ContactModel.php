<?php

namespace App\Models;

use App\Utility\DataBase;
use \PDO;

class ContactModel
{
    private $id;
    private $name;
    private $mail;
    private $message;


public function insertMessage(): bool
{
    $pdo = DataBase::connectPDO();
    
    $sql = "INSERT INTO `contact`(`id`, `name`, `mail`, `message`) VALUES (:id, :name, :mail, :message)";
    
    $params = [
        'id' =>  $this->id,
        'name' => $this->name,
        'mail' => $this->mail,
        'message' => $this->message,
        ];
        $query = $pdo->prepare($sql);
        $queryStatus = $query->execute($params);
        return $queryStatus;
}

public function getMessages(){
    $pdo = DataBase::connectPDO();
    
    $sql = "SELECT * FROM contact";

        $query = $pdo->prepare($sql);
        $query->execute();
        $messages = $query->fetchAll(PDO::FETCH_CLASS,'App\Models\ContactModel');
        return $messages;
}


 public static function deleteMessage(int $contactId): bool
    {
        $pdo = DataBase::connectPDO();
        $sql = 'DELETE FROM `contact` WHERE id = :id';
        $query = $pdo->prepare($sql);
        $query->bindParam('id', $contactId, PDO::PARAM_INT);
        $queryStatus = $query->execute();
        return $queryStatus;
    }
    
    public static function getMessageById($userId): ?array
{
   
    $pdo = DataBase::connectPDO();
    $sql = "SELECT * FROM `users` WHERE id = :userId";
    $query = $pdo->prepare($sql);
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    return $user;
}
    
    
    public function getId(): int
        {
            return $this->id;
        }
        
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    
     public function getName(): string
        {
            return $this->name;
        }
        
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
     public function getMail(): string
        {
            return $this->mail;
        }
        
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }
    
    
     public function getMessage(): string
        {
            return $this->message;
        }
        
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

}