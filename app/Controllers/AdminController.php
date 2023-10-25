<?php 

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\HikingModel;
use App\Models\ContactModel;
use App\Models\UserModel;


class AdminController extends MainController
{
    public function renderAdmin():void
    {
            $this->checkUserAuthorization(1);
            
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["addHikingForm"])) {
                $this->addHiking();
            }
            
            if (isset($_POST["deleteHikingForm"])) {
                $this->removeHiking();
            }
            
            if (isset($_POST["updateHikingForm"])) {
                $this->updateHiking();
            }
            
            if (isset($_POST["userListForm"])) {
                $this->removeUser();
            }
            if (isset($_POST["contactForm"])) {
                $this->removeMessage();
            }
        }
         
        
        $this->viewType = 'admin';
        if($this->view === 'adminMessages'){
            $contactModel = new ContactModel();
            $messages = $contactModel->getMessages();
            $this->data['messages'] = $messages;
        }
        if ($this->view === 'adminUserList'){
            $userModel = new UserModel();
            $users = $userModel->getUsers();
            $this->data['users'] = $users;
        }
        
        if (isset($this->subPage)) {
            $this->view = $this->subPage;
            if ($this->view === 'update') {
                if (isset($_GET['id'])) {
                    $post = HikingModel::getHikingById($_GET['id']);
                    if (is_null($post)) {
                        $this->data['error'] = '<div class="alert alert-danger" role="alert">L\'article n\'existe pas</div>';
                    } else {
                        $this->data['post'] = $post;
                    }
                }
            }
        } else {
            $this->data['posts'] = HikingModel::getPosts();
        }
        
        $this->render();
    }
    
    public function addHiking(): void
    {
         $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL);
         $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
         $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
         $level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_SPECIAL_CHARS);
         $ascent = filter_input(INPUT_POST, 'ascent', FILTER_SANITIZE_NUMBER_INT);
         $descent = filter_input(INPUT_POST, 'descent', FILTER_SANITIZE_NUMBER_INT);
         $duration = filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_NUMBER_INT);
         $length = filter_input(INPUT_POST, 'length', FILTER_SANITIZE_NUMBER_INT);
         $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_SPECIAL_CHARS);
         
         $hikingModel = new HikingModel();
         
         $hikingModel->setImage($image);
         $hikingModel->setTitle($title);
         $hikingModel->setDescription($description);
         $hikingModel->setLevel($level);
         $hikingModel->setAscent($ascent);
         $hikingModel->setDescent($descent);
         $hikingModel->setDuration($duration);
         $hikingModel->setLength($length);
         $hikingModel->setPosition($position);
         
         if ($hikingModel->insertHiking()){
             $this->data[] = '<div class="alert alert-success" role="alert">Article enregistré avec succès</div>';
         } else {
             $this->data[] = '<div class="alert alert-danger" role="alert">Il s\'est produit une erreur</div>';
         }
    }
    
    public function updateHiking(): void
    
    {
         $id = filter_input(INPUT_POST, 'hikingid', FILTER_SANITIZE_NUMBER_INT);
         $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL);
         $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
         $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
         $level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_SPECIAL_CHARS);
         $ascent = filter_input(INPUT_POST, 'ascent', FILTER_SANITIZE_NUMBER_INT);
         $descent = filter_input(INPUT_POST, 'descent', FILTER_SANITIZE_NUMBER_INT);
         $duration = filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_NUMBER_INT);
         $length = filter_input(INPUT_POST, 'length', FILTER_SANITIZE_NUMBER_INT);
         $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_SPECIAL_CHARS);
         
         $hikingModel = new HikingModel();
         
         $hikingModel->setId($id);
         $hikingModel->setImage($image);
         $hikingModel->setTitle($title);
         $hikingModel->setDescription($description);
         $hikingModel->setLevel($level);
         $hikingModel->setAscent($ascent);
         $hikingModel->setDescent($descent);
         $hikingModel->setDuration($duration);
         $hikingModel->setLength($length);
         $hikingModel->setPosition($position);
         
         if ($hikingModel->updateHiking()){
             $this->data[] = '<div class="alertSuccess" role="alert">Article enregistré avec succès</div>';
         } else {
             $this->data[] = '<div class="alertDanger" role="alert">Il s\'est produit une erreur</div>';
         }
    }
    
    public function removeHiking(): void
    {
        $hikingId = filter_input(INPUT_POST, 'hikingid', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if (HikingModel::deleteHiking($hikingId)){
            $this->data['info'] = '<div class="alertSuccess" role="alert">Article supprimé avec succès</div>';
        } else {
            $this->data['info'] = '<div class="alertDanger" role="alert">Il s\'est produit une erreur</div>';
        }
    }
    
    public function removeUser(): void
    {
        $userId = filter_input(INPUT_POST, 'userListid', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if (UserModel::deleteUser($userId)){
            $this->data['info'] = '<div class="alertSuccess" role="alert">Utilisateur supprimé avec succès</div>';
        } else {
            $this->data['info'] = '<div class="alertDanger" role="alert role="alert">Il s\'est produit une erreur</div>';
        }
    }
    
    public function removeMessage(): void
    {
        
        $contactId = filter_input(INPUT_POST, 'contactid', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if (ContactModel::deleteMessage($contactId)){
            $this->data['info'] = '<div class="alertSuccess" role="alert">Utilisateur supprimé avec succès</div>';
        } else {
            $this->data['info'] = '<div class="alertDanger" role="alert">Il s\'est produit une erreur</div>';
        }
        
    }

}