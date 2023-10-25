<?php

namespace App\Controllers;

class ErrorController extends MainController 

{
    public function renderError()
    {
    $this->view = '404';
    http_response_code(404);
    $this->render();
    }
}