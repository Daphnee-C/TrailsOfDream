<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\HikingModel;

class HikingDetailsController extends MainController

{

public function renderHikingDetails(): void
    {
        $this->data =  HikingModel::getHikingById($this->subPage);
        // Construction la page
        $this->render();
    }
}