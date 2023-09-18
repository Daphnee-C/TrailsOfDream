<?php 

namespace App\Controllers;

use App\Controllers\ContactController;
use App\Models\ContactModel;

class ContactController extends MainController
{
    public function renderContact():void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
           
            if (isset($_POST["contactForm"])) {
                
                $this->addMessageContact();
            }
             
        }
        $this->render();
    }
    
    public function addMessageContact(): void
    {
        
         $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
         $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_SPECIAL_CHARS);
         $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
         
         $contactModel = new contactModel();
         
         $contactModel->setName($name);
         $contactModel->setMail($mail);
         $contactModel->setMessage($message);
         
         
         if ($contactModel->insertMessage()){
             $this->data[] = '<div class="alert alert-success" role="alert">Message envoyé avec succès</div>';
         } else {
             $this->data[] = '<div class="alert alert-danger" role="alert">Il s\'est produit une erreur</div>';
         }
    }
    
    
    
}