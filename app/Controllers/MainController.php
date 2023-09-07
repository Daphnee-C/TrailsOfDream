<?php

namespace App\Controllers;


class MainController
{
    
    protected string $view;
    
    protected $subpage;
    
    protected $data;
    // propriété stockant le type de vue (admin/front)

    public function render(): void
    {
               
        
        $data = $this->data;
        // On construit la page 
      var_dump($data);
        require(__DIR__."/../views/front/layouts/header.phtml");
        require(__DIR__."/../views/front/partials/$this->view.phtml");
        require(__DIR__."/../views/front/layouts/footer.phtml");
        
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