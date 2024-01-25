<?php
use VOST\controllers\UserController;

require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/UserController.php';

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $routeCollector){
    $routeCollector->post('/login', function (){
        UserController::login();
    });
    $routeCollector->get('/login', function (){
        require __DIR__.'/../views/login.php';
    });
    $routeCollector->get('/user', function (){
        UserController::getUser();
    });
    $routeCollector->get('/logout', function (){
        $_SESSION = [];
    });
    $routeCollector->get('/send', function (){
        UserController::sendMail();
    });
});