<?php
namespace App\Models;
use App\Utility\DataBase;
use \PDO;


class UserModel
{
    private $id;
    private $firstname;
    private $lastname;
    private $mail;
    private $password;
    private $role;
    
    public function registerUser(): bool
    {
        $pdo = DataBase::connectPDO();
        $sql = "INSERT INTO `users`(`firstname`,`lastname`,`mail`,`password`,`role`) VALUES (:firstname,:lastname,:mail,:password,:role)";
        $pdoStatement = $pdo->prepare($sql);
        $params = [
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':mail' => $this->mail,
            ':password' => $this->password,
            ':role' => 3,
            ];
            
        $queryStatus = $pdoStatement->execute($params);
        return $queryStatus;
    }
    
    public function checkMail(): bool
    {
        $pdo = DataBase::connectPDO();
        $sql = "SELECT COUNT(*) FROM `users` WHERE `mail` = :mail";
        $query = $pdo->prepare($sql);
        $query->bindParam(':mail', $this->mail);
        $query->execute();
        $isMail = $query->fetchColumn();
        return $isMail > 0;
    }
    
    public static function getUserByMail($mail): ?UserModel
    {
        $pdo = DataBase::connectPDO();
        $sql = 'SELECT * FROM users WHERE mail = :mail';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':mail'=> $mail]);
        $result = $pdoStatement->fetchObject('App\Models\UserModel');
        
        if(!$result){
            $result = null;
        }
        return $result;
    }
    
    
    public function getUsers(){
    $pdo = DataBase::connectPDO();
    
    $sql = "SELECT * FROM users";

        $query = $pdo->prepare($sql);
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_CLASS,'App\Models\UserModel');
        return $users;
}

     public static function deleteUser(int $userId): bool
    {
        $pdo = DataBase::connectPDO();
        $sql = 'DELETE FROM `users` WHERE id = :id';
        $query = $pdo->prepare($sql);
        $query->bindParam('id', $userId, PDO::PARAM_INT);
        $queryStatus = $query->execute();
        return $queryStatus;
    }
    
     public static function getUserById($userId): ?array
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

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }
    
     public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    
}