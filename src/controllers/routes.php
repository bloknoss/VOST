<?php

use VOST\controllers\UserController;
use VOST\controllers\VinylController;
use VOST\controllers\CartController;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/VinylController.php';
require __DIR__ . '/CartController.php';

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $routeCollector) {
    $routeCollector->get('/', function () {
        require __DIR__ . '/../views/index.php';
    });

    $routeCollector->addGroup('/user', function (FastRoute\RouteCollector $routeCollector) {
        require __DIR__ . '/UserController.php';

        $routeCollector->get('', function () {
            UserController::getUserInfo();
        });

        $routeCollector->post('/login', function () {
            UserController::login();
        });

        $routeCollector->get('/login', function () {
            require __DIR__ . '/../views/login.php';
        });

        $routeCollector->get('/logout', function () {
            UserController::logOut();
        });

        $routeCollector->get('/register', function () {
            require __DIR__ . '/../views/register.php';
        });

        $routeCollector->post('/register', function () {
            UserController::register();
        });

        $routeCollector->post('/activate', function () {
            UserController::validateActivation();
        });

        $routeCollector->post('/edit', function () {
            UserController::editUser();
        });

        $routeCollector->get('/orders', function () {
            UserController::getUserOrders();
        });

        $routeCollector->addGroup('/cart', function (FastRoute\RouteCollector $routeCollector) {

            $routeCollector->post('', function () {
                CartController::addToCart();
            });

            $routeCollector->get('', function () {
                CartController::getCart();
            });

            $routeCollector->delete('/{id:\d+}', function ($idVinyl){
                CartController::deleteCart($idVinyl);
            });

            $routeCollector->put('/{id:\d+}', function ($idVinyl){
                CartController::updateCart($idVinyl);
            });
        });


    });

    $routeCollector->get('/shop', function () {
        VinylController::getVinyls();

    });

    $routeCollector->addGroup('/vinyl', function (FastRoute\RouteCollector $routeCollector) {

        $routeCollector->get('/{id:\d+}', function ($id) {
            VinylController::getVinyl($id['id']);
        });
    });


});