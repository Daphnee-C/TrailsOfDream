<?php

namespace App\Controllers;

use App\Controllers\MainControllers;
use App\Models\ArticlesModel;


class ArticlesController extends MainController {
    
    public function renderArticles() {

        $this->data = ArticlesModel::getArticles();
        // Méthode render du MainController qui construit la page
        $this->render();
    }
    
}