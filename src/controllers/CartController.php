<?php

namespace VOST\controllers;

use VOST\models\database\DatabaseUtils as DbUtils;
use VOST\models\CartModel;
use VOST\models\tables\CartVinyls;


require __DIR__ . '/../models/tables/CartVinyls.php';
require __DIR__ . '/../models/CartModel.php';

class CartController
{
    public static function getCart()
    {
        if (!isset($_SESSION["isLogged"])) {
            header('Location: http://localhost:80/user/login');
            exit(300);
        }

        try {
            $pdo = DbUtils::dbConnect();
            $cart = CartModel::getCartVinyls($pdo, $_SESSION["user"]->id_user);

            require __DIR__ . '/../views/cart.php';
            exit(200);
        } catch (\PDOException $exception) {
            die(500);
        }

    }
    public static function addToCart()
    {
        if (!isset($_SESSION["isLogged"])) {
            header('Location: http://localhost:80/user/login');
            exit(300);
        }
        if (!isset($_POST["id_vinyl"])) {
            header('Location: http://localhost:80/shop');
            exit(300);
        }
        $id_vinyl = $_POST["id_vinyl"];

        try {
            $pdo = DbUtils::dbConnect();
            $result = CartModel::addVinylToCart($pdo, new CartVinyls($_SESSION["user"]->id_user, $id_vinyl));
            print $result;
        } catch (\PDOException $e) {
            die(500);
        }

        exit(200);
    }
    public static function deleteCartItem($idVinyl)
    {
        if (!isset($_SESSION["isLogged"])) {
            header('Location: http://localhost:80/user/login');
            exit(300);
        }

        try {
            $pdo = DbUtils::dbConnect();
            $result = CartModel::deleteFromCart($pdo, $_SESSION["user"]->id_user, $idVinyl['id']);
            print $result;
            exit(200);
        }catch (\PDOException $e){
            die(500);
        }
    }

    public static function updateCart($idVinyl, $body)
    {
        if (!isset($_SESSION["isLogged"])) {
            header('Location: http://localhost:80/user/login');
            exit(300);
        }
        if (!isset($body->quantity)){
            print 'Debes enviar un cuerpo con la request';
            exit(200);
        }
        $quantity = intval( $body->quantity);

        if ($quantity <= 0){
            print 'No puedes tener menos de 1 vinilo en el carrito';
        }

        try {
            $pdo = DbUtils::dbConnect();
            $respons = CartModel::updateVinylQuantity($pdo, new CartVinyls($_SESSION["user"]->id_user, $idVinyl, $quantity) );
            print $respons;
            die(200);
        }catch (\PDOException $e){
            die(500);
        }
    }
}