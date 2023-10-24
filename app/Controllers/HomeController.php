<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\HikingModel;
use App\Models\ArticlesModel;
use App\Models\UserModel;

class HomeController extends MainController
{

    public function renderHome(): void
    {
        
        
      $this->data = [];
      $this->data['resultHikings'] = HikingModel::getPosts();  
      $this->data['resultArticles'] = ArticlesModel::getArticles();
       $this->data['resultUser'] = UserModel::getUserById(2);
      
      
       
        $this->render();
    }
}