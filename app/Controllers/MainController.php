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
        if (isset($_SESSION['user_id'])) {
            $currentUserRole = $_SESSION['user_role'];
            if ($currentUserRole <= $role) {
                return true;
            } else {
                http_response_code(403);
                $this->view = '403';
                $this->render();
                exit();
            }
        } else {
            $redirect = explode('/public/', $_SERVER['REQUEST_URI']);
            header('Location: ' . $redirect[0] . '/public/login');
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