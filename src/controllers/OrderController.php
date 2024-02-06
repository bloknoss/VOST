<?php

namespace VOST\controllers;

use VOST\controllers\Validator;
use VOST\models\database\DatabaseUtils as DbUtils;
use VOST\models\OrderModel;
use VOST\models\tables\Order;
use VOST\models\tables\Vinyl;
use VOST\models\AddressModel;
use VOST\models\CartModel;
use VOST\models\tables\VinylsOrdered;
use VOST\models\VinylModel;
use VOST\models\VinylsOrderedModel;


require __DIR__ . '/../models/VinylsOrderedModel.php';
require __DIR__ . '/../models/OrderModel.php';

class OrderController
{

    public static function getOrders(): never
    {
        Validator::isLogged();
        try {
            $pdo = DbUtils::dbConnect();
            $orders = OrderModel::getUserOrders($pdo, $_SESSION["user"]->id_user);
            require __DIR__ . '/../views/order.php';
            exit(200);
        } catch (\PDOException $exception) {
            print 'Internal server error';
            die(500);
        }
    }

    public static function addOrders(): never
    {
        Validator::isLogged();
        $fields = ["id_address" => null, "id_vinyls" => null];
        Validator::validateFields(array_keys($fields), $fields, fn() => exit(400));

        try {
            $pdo = DbUtils::dbConnect();
            $date = date('Y-m-d h:mi:s');
            $result = OrderModel::insertOrder($pdo, new Order(null, date('Y-m-d h:mi:s'), $_POST["id_address"]));

            if ($result <= 0) {
                print 'Ha habido un problema inesperado';
                exit(500);
            }

            $order = OrderModel::getOrderId($pdo, $date);
            $order = $order[0]['id_order'];

            foreach ($_POST["id_vinyls"] as $id_vinyl) {
                $vinyl = VinylModel::getVinyl($pdo, new Vinyl($id_vinyl, null, null, null, null, null, null));
                $quantity = $_POST["quantity"][$id_vinyl];
                $quantity = intval($quantity);

                if ($quantity > $vinyl->stock) {
                    print "Demasiadas unidades de $vinyl->name";
                    continue;
                }
                print '//'. $id_vinyl .'//'. $order.'//'.$quantity .'//';
                $result = VinylsOrderedModel::insertVinylOrdered($pdo, new VinylsOrdered($id_vinyl, $order, $quantity));

                VinylModel::updateVinyl($pdo, new Vinyl($id_vinyl, null, $vinyl->stock - $quantity, null, null, null, null));
            }
            exit(200);
        } catch (\PDOException $exception) {
            die(500);
        }
    }

    public static function getOrderedVinyls($id)
    {
        Validator::isLogged();

        try {
            $pdo = DbUtils::dbConnect();
            $vinyls = OrderModel::getOrderedVinyls($pdo, $id);
            require __DIR__.'/../views/vinyl.php';
            exit(202);
        } catch (\PDOException $e) {
            die(500);
        }
    }
}