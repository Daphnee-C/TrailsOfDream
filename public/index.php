<?php
require __DIR__.'/../vendor/autoload.php';
session_start();

const AVAIABLE_ROUTES = [
    'home'=>[
        'action' => 'renderHome',
        'controller' => 'HomeController'
    ],
    'contact'=>[
        'action' => 'renderContact',
        'controller' => 'ContactController'
    ],
    '404'=>[
        'action' => 'renderError',
        'controller' => 'ErrorController'
    ],
    'hikingList'=>[
        'action' => 'renderHikingList',
        'controller' => 'HikingListController'
    ],
    'hikingDetails'=>[
        'action' => 'renderHikingDetails',
        'controller' => 'HikingDetailsController'
    ],
    'articles'=>[
        'action' => 'renderArticles',
        'controller' => 'ArticlesController'
    ],
    'articlesDetails'=>[
        'action' => 'renderArticlesDetails',
        'controller' => 'ArticlesDetailsController'
    ],
    'login'=>[
        'action' => 'renderUser',
        'controller' => 'UserController'
    ],
    'logout'=>[
        'action' => 'renderUser',
        'controller' => 'UserController'
    ],
    'register'=>[
        'action' => 'renderUser',
        'controller' => 'UserController'
    ],
    
    'admin'=>[
        'action' => 'renderAdmin',
        'controller' => 'AdminController'
    ],
        
    'adminMessages'=>[
        'action' => 'renderAdmin',
        'controller' => 'AdminController'
    ],
    'adminUserList'=>[
        'action' => 'renderAdmin',
        'controller' => 'AdminController'
    ],
    'confidentialite'=>[
        'action' => 'renderConfidentialite',
        'controller' => 'ConfidentialiteController'
    ],
];

$page = 'home';
$controller;
$subPage=null;

// s'il y a un param GET page, on le stock dans la var page sinon on redirige vers home
if(isset($_GET['page']) && !empty($_GET['page'])){    
    $page = $_GET['page'];
    if(!empty($_GET['subpage'])){
        $subPage = $_GET['subpage'];
    }

}else{
    $page = 'home';     
}


if(array_key_exists($page,AVAIABLE_ROUTES)){
    $controller = AVAIABLE_ROUTES[$page]['controller'];
    $controllerAction = AVAIABLE_ROUTES[$page]['action'];
}else{
    // si la route ne correspond pas, on appelle ErrorController
    $controller = 'ErrorController';
    $controllerAction = 'renderError';
}

$namespace = 'App\Controllers';
    $controllerClassName = $namespace . '\\' . $controller;

// Instanciation de la classe en utilisant le nom complet (namespace + nom de la classe)
$pageController = new $controllerClassName();

// On alimente la propriété view du controller avec le nom de la page demandée.
$pageController->setView($page);

$pageController->setSubPage($subPage);

// On appelle la méthode du controller demandée
$pageController->$controllerAction();