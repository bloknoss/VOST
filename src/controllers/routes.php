<?php

use VOST\controllers\AddressController;
use VOST\controllers\CartController;
use VOST\controllers\UserController;
use VOST\controllers\VinylController;
use VOST\models\Utils;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/VinylController.php';
require __DIR__ . '/CartController.php';
require __DIR__ . '/AddressController.php';
require __DIR__ . '/Validator.php';
require __DIR__ . '/../models/Utils.php';

foreach ($_POST as $postField => $post) {
    $_POST[$postField] = Utils::validateData($post);
}
return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $routeCollector) {
    $routeCollector->get('/', fn() => require __DIR__ . '/../views/index.php');

    $routeCollector->addGroup('/user', function (FastRoute\RouteCollector $routeCollector) {
        require __DIR__ . '/UserController.php';

        $routeCollector->get('', fn() => UserController::getUserInfo());

        $routeCollector->post('/login', fn() => UserController::login());

        $routeCollector->get('/login', fn() => require __DIR__ . '/../views/login.php');

        $routeCollector->get('/logout', fn() => UserController::logOut());

        $routeCollector->get('/register', fn() => require __DIR__ . '/../views/register.php');

        $routeCollector->post('/register', fn() => UserController::register());

        $routeCollector->post('/activate', fn() => UserController::validateActivation());

        $routeCollector->post('/edit', fn() => UserController::editUser());

        $routeCollector->addGroup('/address', function (FastRoute\RouteCollector $routeCollector){

            $routeCollector->get('', fn() => AddressController::getAdresses());

            $routeCollector->post('', fn() => AddressController::addAddress());
        });

        $routeCollector->addGroup('/orders', function (FastRoute\RouteCollector $routeCollector) {
            $routeCollector->get('', function () {
                UserController::getUserOrders();
            });
            $routeCollector->post('', function () {

            });
        });


        $routeCollector->addGroup('/cart', function (FastRoute\RouteCollector $routeCollector) {

            $routeCollector->post('', fn() => CartController::addToCart());

            $routeCollector->get('', fn() => CartController::getCart());

            $routeCollector->delete('/{id:\d+}', fn($idVinyl) => CartController::deleteCartItem($idVinyl));
            
            $routeCollector->put('/{id:\d+}', function ($idVinyl) {
                $body = file_get_contents('php://input');
                CartController::updateCart($idVinyl['id'], json_decode($body));
            });
        });


    });

    $routeCollector->get('/shop', fn() => VinylController::getVinyls());

    $routeCollector->addGroup('/vinyl', function (FastRoute\RouteCollector $routeCollector) {
        $routeCollector->get('/{id:\d+}', fn($id) => VinylController::getVinyl($id['id']));
    });


});