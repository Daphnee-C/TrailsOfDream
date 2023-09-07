<?php

namespace App\Controllers;

use App\Controllers\MainController;

class HomeController extends MainController
{

    public function renderHome(): void
    {
        
        $this->render();
    }
}
