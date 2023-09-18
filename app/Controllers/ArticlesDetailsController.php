<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\ArticlesModel;

class ArticlesDetailsController extends MainController

{

public function renderArticlesDetails(): void
    {
        $this->data =  ArticlesModel::getArticlesById($this->subPage);
        $this->render();
    }
}