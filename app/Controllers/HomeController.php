<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\HikingModel;
/*use App\Models\ArticlesModel;*/




class HomeController extends MainController
{

    public function renderHome(): void
    {
       $hikingModel = new HikingModel();
      /* $artciclesModel = new ArticlesModel();*/
       
       
       $this->data['hiking'] = $hikingModel->getPosts();
      /* $this->data['articles'] = $articlesModel->getArticles();*/
       
       
        $this->render();
    }
}