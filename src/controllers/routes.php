<?php

use VOST\controllers\UserController;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/UserController.php';

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $routeCollector) {
    $routeCollector->get('/', function () {
        require __DIR__ . '/../views/index.php';
    });
    $routeCollector->addGroup('/user', function (FastRoute\RouteCollector $routeCollector) {

        $routeCollector->get('', function () {
            UserController::get();
        });

        $routeCollector->post('/login', function () {
            UserController::login();
        });

        $routeCollector->get('/login', function () {
            require __DIR__ . '/../views/login.php';
        });

        $routeCollector->get('/logout', function () {
            $_SESSION = [];
        });

        $routeCollector->get('/register', function () {
            require __DIR__ . '/../views/register.php';
        });

        $routeCollector->post('/register', function () {
            UserController::createUser();
        });
        $routeCollector->post('/activate', function () {
            UserController::checkCode();
        });

        $routeCollector->get('/test', function () {
            require __DIR__ . '/../models/tester.php';
        });

    });




});