<?php

namespace App\Controllers;


class MainController
{
    
    protected string $view;
    
    protected $subpage;
    
    protected $data;
    // propriété stockant le type de vue (admin/front)
    
    protected string $viewType = 'front';


    public function render(): void
    {
        
        $base_uri = explode('/public/', $_SERVER['REQUEST_URI']);
       
        
        $data = $this->data;
        // On construit la page 
        require __DIR__ . '/../views/' . $this->viewType . '/layouts/header.phtml';
        require __DIR__ . '/../views/' . $this->viewType . '/partials/' . $this->view . '.phtml';
        require __DIR__ . '/../views/' . $this->viewType . '/layouts/footer.phtml';
        
    }
    
     protected function checkUserAuthorization(int $role): bool
    {
        // S'il y'a une session user
        if (isset($_SESSION['user_id'])) {
            // on stocke les données de la session dans une variables
            //  on récupère le rôle
            $currentUserRole = $_SESSION['user_role'];
            // Si le rôle est inférieur ou égal au role demandé (le rôle 1 est le plus haut)
            if ($currentUserRole <= $role) {
                // on renvoie true
                return true;
            } else {
                // sinon, on renvoie un code d'erreur 403
                http_response_code(403);
                // on alimente la propriété view avec la vue 403
                $this->view = '403';
                // on construit la page
                $this->render();
                // on arrête le script
                exit();
            }
        } else {
            // sinon s'il n'ya pas de session user
            // on créer une url de redirection
            $redirect = explode('/public/', $_SERVER['REQUEST_URI']);
            // on redirige vers la page de connexion
            header('Location: ' . $redirect[0] . '/public/login');
            // on arrête le script
            exit();
        }
    }

    
    public function getView(): string
    {
        return $this->view;
    }
    
   
    public function setView(string $view): void
    {
        $this->view = $view;
    }
    
    public function getSubPage(): string
    {
        return $this->subPage;
    }
    
    public function setSubPage(?string $value): void
    {
        $this->subPage = $value;
    }
    
}