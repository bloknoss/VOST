<?php

namespace VOST\models;

include_once 'order.php';
include_once 'database.php';

use PDO;
use PDOException;
use VOST\models\Order;
use VOST\models\Utils;
use VOST\models\Database;

class OrderModel
{

    public static function getOrders($pdo, $order)
    {
        $tableName = $order->tableInfo['tableName'];
        $queryResults = Database::getItems($pdo, $tableName);
        return $queryResults;
    }

    public static function getOrder($pdo, $order)
    {
        $queryResults = Database::getItem($pdo, $order);
        return $queryResults;
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