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