<?php

use VOST\controllers\AddressController;
use VOST\controllers\CartController;
use VOST\controllers\UserController;
use VOST\controllers\VinylController;
use VOST\controllers\OrderController;
use VOST\controllers\Validator;
use VOST\models\Utils;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/VinylController.php';
require __DIR__ . '/CartController.php';
require __DIR__ . '/AddressController.php';
require __DIR__ . '/OrderController.php';
require __DIR__ . '/Validator.php';
require __DIR__ . '/../models/Utils.php';

//aplico validacion a todos los inputs
foreach ($_POST as $postField => $post) {
    $_POST[$postField] = is_string($post) ? Utils::validateData($post) : $post;
}

Validator::isInactive();

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $routeCollector) {
    $routeCollector->get('/', fn() => require __DIR__ . '/../views/index.php');

    $routeCollector->addGroup('/user', function (FastRoute\RouteCollector $routeCollector) {
        require __DIR__ . '/UserController.php';

        $routeCollector->get('', fn() => UserController::getUserInfo());

        $routeCollector->get('/logout', fn() => UserController::logOut());

        $routeCollector->post('/activate', fn() => UserController::validateActivation());

        $routeCollector->post('/edit', fn() => UserController::editUser());

        $routeCollector->addGroup('/login', function (FastRoute\RouteCollector $routeCollector) {
            $routeCollector->post('', fn() => UserController::login());

            $routeCollector->get('', fn() => require __DIR__ . '/../views/login.php');
        });


        $routeCollector->addGroup('/register', function (FastRoute\RouteCollector $routeCollector) {
            $routeCollector->get('', fn() => require __DIR__ . '/../views/register.php');

            $routeCollector->post('', fn() => UserController::register());
        });

        $routeCollector->addGroup('/address', function (FastRoute\RouteCollector $routeCollector) {

            $routeCollector->get('', fn() => AddressController::getAdresses());

            $routeCollector->post('', fn() => AddressController::addAddress());

            $routeCollector->delete('/{id:\d+}', fn($id_address) => AddressController::deleteAddress($id_address['id']));
        });

        $routeCollector->addGroup('/orders', function (FastRoute\RouteCollector $routeCollector) {
            $routeCollector->get('', function () {
                OrderController::getOrders();
            });
            $routeCollector->post('', function () {
                OrderController::addOrders();
            });
            $routeCollector->get('/{id:\d+}', fn($id) => OrderController::getOrderedVinyls($id['id']));
        });


        $routeCollector->addGroup('/cart', function (FastRoute\RouteCollector $routeCollector) {

            $routeCollector->post('/{id:\d+}', fn($id_vinyl) => CartController::addToCart($id_vinyl['id']));

            $routeCollector->get('', fn() => CartController::getCart());

            $routeCollector->delete('', fn() => CartController::deleteCart());

            $routeCollector->delete('/{id:\d+}', fn($idVinyl) => CartController::deleteCartItem($idVinyl['id']));

            $routeCollector->put('/{id:\d+}', function ($idVinyl) {
                $body = file_get_contents('php://input');
                CartController::updateCart($idVinyl['id'], json_decode($body));
            });
        });


    });

    $routeCollector->get('/shop', fn() => VinylController::getVinyls());

    $routeCollector->addGroup('/vinyl', function (FastRoute\RouteCollector $routeCollector) {
        $routeCollector->get('/{id:\d+}', fn($id) => VinylController::getVinyl($id['id']));

        $routeCollector->get('/{id:\d+}/song', fn($id) => VinylController::getSongs($id['id']));
    });


});