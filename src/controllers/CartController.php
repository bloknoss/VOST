<?php

namespace VOST\controllers;

use VOST\models\AddressModel;
use VOST\models\CartModel;
use VOST\models\database\DatabaseUtils as DbUtils;
use VOST\models\tables\CartVinyls;
use VOST\controllers\Validator;

require __DIR__ . '/../models/tables/CartVinyls.php';
require __DIR__ . '/../models/CartModel.php';

class CartController
{


    public static function getCart(): never
    {
        Validator::isLogged();

        try {
            $pdo = DbUtils::dbConnect();
            $cart = CartModel::getCartVinyls($pdo, $_SESSION["user"]->id_user);
            $addresses = AddressModel::getUserAddresses($pdo, $_SESSION["user"]->id_user);
    
            require __DIR__ . '/../views/cart.php';
            exit(202);
        } catch (\PDOException $exception) {
            die(500);
        }
    }

    public static function addToCart($id_vinyl): never
    {
        Validator::isLogged();

        if (!isset($_POST["quantity"])) {
            require __DIR__ . '/../views/cart.php';
            exit(301);
        }
        $quantity = intval($_POST["quantity"]);
        $quantity = ($quantity <= 0) ? $_POST["quantity"] : 1;

        try {
            $pdo = DbUtils::dbConnect();
            $result = CartModel::addVinylToCart($pdo, new CartVinyls($_SESSION["user"]->id_user, $id_vinyl, $quantity));
            print $result;
            exit(Validator::$statusCode[$result]);
        } catch (\PDOException $e) {
            die(500);
        }
    }

    public static function deleteCartItem($id_vinyl): never
    {
        Validator::isLogged();

        try {
            $pdo = DbUtils::dbConnect();
            $result = CartModel::deleteFromCart($pdo, $_SESSION["user"]->id_user, $id_vinyl);
            print $result;
            exit(Validator::$statusCode[$result]);
        } catch (\PDOException $e) {
            die(500);
        }
    }

    public static function deleteCart(): never
    {
        Validator::isLogged();

        try {
            $pdo = DbUtils::dbConnect();
            $result = CartModel::deleteCart($pdo, $_SESSION["user"]->id_user);

            print $result;
            $result = ($result > 1) ? 1 : $result;
            exit(Validator::$statusCode[$result]);
        } catch (\PDOException $exception) {
            die(500);
        }
    }

    public static function updateCart($idVinyl, $body): never
    {
        Validator::isLogged();

        if (!isset($body->quantity)) {
            print 'Debes enviar un cuerpo con la request';
            exit(400);
        }
        $quantity = intval($body->quantity);

        $quantity = ($quantity <= 0) ? 1 : $quantity;

        try {
            $pdo = DbUtils::dbConnect();
            $result = CartModel::updateVinylQuantity($pdo, new CartVinyls($_SESSION["user"]->id_user, $idVinyl, $quantity));
            print $result;
            exit(Validator::$statusCode[$result]);
        } catch (\PDOException $e) {
            die(500);
        }
    }
}
