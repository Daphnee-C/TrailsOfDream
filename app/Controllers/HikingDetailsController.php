<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\HikingModel;

class HikingDetailsController extends MainController

{



public function renderHikingDetails(): void
    {
        $this->data =  HikingModel::getHikingById($this->subPage);
        // on construit la page
        $this->render();
    }
}