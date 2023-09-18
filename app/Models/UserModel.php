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
    var_dump($userId);
    $pdo = DataBase::connectPDO();
    $sql = "SELECT * FROM `users` WHERE id = :userId";
    $query = $pdo->prepare($sql);
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);
    var_dump($user);
    return $user;
}
    
    
     public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the value of name
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Set the value of name
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }
    
    
     public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Set the value of name
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * Get the value of email
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * Set the value of email
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Get the value of role
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * Set the value of role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    
}