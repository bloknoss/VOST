<?php

use VOST\controllers\UserController;
use VOST\controllers\VinylController;
use VOST\controllers\CartController;
use VOST\controllers\AddressController;
use VOST\models\Utils;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/VinylController.php';
require __DIR__ . '/CartController.php';
require __DIR__ . '/AddressController.php';
require __DIR__ . '/../models/Utils.php';

foreach ($_POST as $postField => $post) {
    $_POST[$postField] = Utils::validateData($post);
}
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
        $routeCollector->addGroup('/address', function (FastRoute\RouteCollector $routeCollector){
            $routeCollector->get('', function (){
                AddressController::getAdresses();
            });
            $routeCollector->post('', function () {
                AddressController::addAddress();
            });
        });

        $routeCollector->addGroup('/orders', function (FastRoute\RouteCollector $routeCollector) {
            $routeCollector->get('', function () {
                UserController::getUserOrders();
            });
            $routeCollector->post('', function () {

            });
        });


        $routeCollector->addGroup('/cart', function (FastRoute\RouteCollector $routeCollector) {

            $routeCollector->post('', function () {
                CartController::addToCart();
            });

            $routeCollector->get('', function () {
                CartController::getCart();
            });

            $routeCollector->delete('/{id:\d+}', function ($idVinyl) {
                CartController::deleteCartItem($idVinyl);
            });

            $routeCollector->put('/{id:\d+}', function ($idVinyl) {
                $body = file_get_contents('php://input');
                CartController::updateCart($idVinyl['id'], json_decode($body));
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