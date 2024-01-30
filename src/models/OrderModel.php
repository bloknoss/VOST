<?php

namespace VOST\models;

include_once 'Order.php';
include_once 'Database.php';

use VOST\models\Order;
use VOST\models\Database;

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
        $queryResults = Database::getItem($pdo, $order);
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
        $queryResults = Database::insertItem($pdo, $newOrder);
        return $queryResults;
    }

    public static function updateOrder($pdo, $order)
    {
        $queryResults = Database::updateTable($pdo, $order);
        return $queryResults;
    }

}