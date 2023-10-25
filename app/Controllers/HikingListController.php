<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\HikingModel;

class HikingListController extends MainController {
    
    public function renderHikingList() {

        $this->data = HikingModel::getPosts();
        $this->render();
    }
}