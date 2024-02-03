<?php

namespace VOST\models;

include_once __DIR__ . '/tables/Order.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

use PDO;
use PDOException;
use VOST\models\tables\Order;
use VOST\models\database\DatabaseUtils;

class OrderModel
{

    public static function getOrders($pdo)
    {

        $tableName = "orders";
        $queryResults = DatabaseUtils::getItems($pdo, $tableName);
        $abstractedObjects = [];
        foreach ($queryResults as $array)
            $abstractedObjects[] = Order::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getOrder($pdo, $order)
    {
        $queryResults = DatabaseUtils::getItem($pdo, $order);
        $abstractedObject = Order::constructFromArray($queryResults);
        return $abstractedObject;
    }

    public static function deleteOrder($pdo, $order)
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $order);
        return $queryResults;
    }

    public static function insertOrder($pdo, $newOrder)
    {
        $queryResults = DatabaseUtils::insertItem($pdo, $newOrder);
        return $queryResults;
    }

    public static function updateOrder($pdo, $order)
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $order);
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
