<?php

namespace VOST\models\database;

include_once 'Order.php';
include_once 'Database.php';

use PDO;
use PDOException;
use VOST\models\Order;

class OrderModel
{

    public static function getOrders($pdo)
    {

        $tableName = "orders";
        $queryResults = Database::getItems($pdo, $tableName);
        $abstractedObjects = [];
        foreach ($queryResults as $array)
            $abstractedObjects[] = Order::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getOrder($pdo, $order)
    {
        $queryResults = \VOST\models\database\Database::getItem($pdo, $order);
        $abstractedObject = Order::constructFromArray($queryResults);
        return $abstractedObject;
    }

    public static function deleteOrder($pdo, $order)
    {
        $queryResults = Database::deleteItem($pdo, $order);
        return $queryResults;
    }

    public static function insertOrder($pdo, $newOrder)
    {
        $queryResults = \VOST\models\database\Database::insertItem($pdo, $newOrder);
        return $queryResults;
    }

    public static function updateOrder($pdo, $order)
    {
        $queryResults = Database::updateTable($pdo, $order);
        return $queryResults;
    }


    public static function getOrderedVinyls($pdo, $orderId)
    {
        try {
            $query = "select vinyls.id_vinyl, name, stock, price, style, duration, max_duration from vinyls inner join vinyls_ordered on vinyls_ordered.id_vinyl = vinyls.id_vinyl where vinyls_ordered.id_order=:id_order;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_order", $orderId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            echo ("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die(500);
        }
    }

}