<?php

use VOST\controllers\UserController;
use VOST\controllers\VinylController;

require __DIR__ . '/../../vendor/autoload.php';


return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $routeCollector) {
    $routeCollector->get('/',function (){
        require __DIR__ . '/../views/index.php';
    });
    $routeCollector->addGroup('/user' , function (FastRoute\RouteCollector $routeCollector){
        require __DIR__ . '/UserController.php';



        $routeCollector->post('/login', function () {
            UserController::login();
        });

        $routeCollector->get('/login', function () {
            require __DIR__ . '/../views/login.php';
        });

        $routeCollector->get('/logout', function () {
            UserController::logOut();
        });

        $routeCollector->get('/register', function (){
            require __DIR__ . '/../views/register.php';
        });

        $routeCollector->post('/register', function (){
            UserController::register();
        });
        $routeCollector->post('/activate', function (){
            UserController::validateActivation();
        });

        if (!isset($_SESSION["isLogged"])){

        }

        $routeCollector->get('', function () {
            UserController::getUserInfo();
        });

        $routeCollector->post('/edit', function (){
            UserController::editUser();
        });
        $routeCollector->get('/orders', function (){
            UserController::getUserOrders();
        });

    });
    $routeCollector->addGroup('/vinyl', function (FastRoute\RouteCollector $routeCollector){
        require __DIR__.'/VinylController.php';

        $routeCollector->get('', function (){
            VinylController::getVinyls();
        });
    });
    



});