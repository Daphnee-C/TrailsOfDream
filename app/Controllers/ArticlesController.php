<?php

namespace App\Controllers;

use App\Controllers\MainControllers;
use App\Models\ArticlesModel;

class ArticlesController extends MainController {
    
    public function renderArticles() {

        $this->data =ArticlesModel::getArticles();
        // on appelle la méthode render du MainController qui construit la page
        $this->render();
    }
    
}