<?php

namespace App\Controllers;
use App\Models\UserModel;

class UserController extends MainController
 {
   
 public function renderUser(): void
    {
        if ($this->view === 'logout') {
            $this->logout();
        } else {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (isset($_POST["registerForm"])) {
                    $this->register();
                } elseif (isset($_POST["loginForm"])) {
                    $this->login();
                }
            }
        }
        // Construction de la page
        $this->render();
    }

    // méthode permettant l'inscription d'un utilisateur
    public function register(): void
    {

        $errors = 0;
        $mail = filter_input(INPUT_POST, 'mail');
        $password = filter_input(INPUT_POST, 'password');
        $firstname = filter_input(INPUT_POST, 'firstname');
        $lastname = filter_input(INPUT_POST, 'lastname');

        if (!$mail || !$password || !$firstname || !$lastname) {
            $errors = 1;
            // on stocke dans la propriété data le message d'erreur que l'on va afficher dans la vue ensuite
            $this->data[] = '<div class="alertDanger" role="alert">Tous les champs sont obligatoires</div>';
        }

        $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
        if ($mail === false) {
            $errors = 1;
            $this->data[] = '<div class="alertDanger" role="alert">Le format de l\'email n\'est pas valide.</div>';
        }
        if (strlen($password) < 8) {
            $errors = 1;
            $this->data[] = '<div class="alertDanger" role="alert">Le mot de passe doit contenir au moins 8 caractères.</div>';
        }

        if ($errors < 1) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // instanciation de UserModel
            $user = new UserModel();
            // Propriétés alimentée grâce aux setters
            $user->setMail($mail);
            $user->setPassword($hashedPassword);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setRole(3);

            if ($user->checkMail()) {
                $errors = 1;
                $this->data[] = '<div class="alertDanger" role="alert">Cet email est déjà pris, veuillez en choisir un autre.</div>';
            }
            
            if ($errors < 1) {
                // utilisateur enregistré en appellant la méthode registerUser, elle renvera true ou false
                if ($user->registerUser()) {
                    $this->data[] =  '<div class="alertSuccess" role="alert">Enregistrement réussi, vous pouvez maintenant vous connecter</div>';
                } else {
                    $this->data[] = '<div class="alertDanger" role="alert">Il y a eu une erreur lors de l\enregistrement</div>';
                }
            }
        }
    }


    public function login(): void
    {

        $errors = 0;
        // instanciation nouveau UserModel
        $user = new UserModel();
        $user = $user->getUserByMail($_POST['mail']);

        if (is_null($user)) {
            $errors = 1;
        } else {
            if (password_verify($_POST['password'], $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_role'] = $user->getRole();                
                $this->data[] =  '<div class="alertSuccess" role="alert">connexion réussie ! votre compte doit être modifié par un admin pour que vous ayez accès à l\'administration</div>';
                $base_uri = explode('index.php', $_SERVER['SCRIPT_NAME']);
                if($user->getRole() < 3){
                    header('Location:' . $base_uri[0] . 'admin');
                }                
            } else {
                $errors = 1;
            }
        }
        if ($errors > 0) {
            $this->data[] = '<div class="alertDanger" role="alert">Email ou mot de passe incorrect</div>';
        }
    }

    public function logout(): void
    {
        //supprime données de userObject.
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        session_destroy();
        $base_uri = explode('index.php', $_SERVER['SCRIPT_NAME']);
        header('Location:' . $base_uri[0] . 'home');
    }
    
}