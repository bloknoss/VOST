<?php

namespace VOST\models;

include_once __DIR__ . '/tables/Order.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

use PDO;
use PDOException;
use VOST\models\tables\Order;
use VOST\models\database\DatabaseUtils;
use VOST\models\tables\Vinyl;

class OrderModel
{

    /**
     * getOrders
     *
     * @param  mixed $pdo
     * @return array
     */
    public static function getOrders($pdo): array
    {

        $tableName = "orders";
        $queryResults = DatabaseUtils::getItems($pdo, $tableName);
        $orders = [];
        foreach ($queryResults as $array)
            $orders[] = Order::constructFromArray($array);

        return $orders;
    }

    /**
     * getOrder
     *
     * @param  mixed $pdo
     * @param  mixed $order
     * @return Order
     */
    public static function getOrder($pdo, $order): Order
    {
        $queryResults = DatabaseUtils::getItem($pdo, $order);
        $abstractedObject = Order::constructFromArray($queryResults);
        return $abstractedObject;
    }

    /**
     * deleteOrder
     *
     * @param  mixed $pdo
     * @param  mixed $order
     * @return int
     */
    public static function deleteOrder($pdo, $order): int
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $order);
        return $queryResults;
    }

    /**
     * insertOrder
     *
     * @param  mixed $pdo
     * @param  mixed $newOrder
     * @return int
     */
    public static function insertOrder($pdo, $newOrder): int
    {
        $queryResults = DatabaseUtils::insertItem($pdo, $newOrder);
        return $queryResults;
    }

    /**
     * updateOrder
     *
     * @param  mixed $pdo
     * @param  mixed $order
     * @return int
     */
    public static function updateOrder($pdo, $order): int
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $order);
        return $queryResults;
    }

    public static function getUserOrders($pdo, $idUser): array | null
    {
        try {
            $query = "select orders.id_order, orders.date_time, orders.id_address from orders inner join addresses on addresses.id_address=orders.id_address inner join users on users.id_user=addresses.id_user where users.id_user=:id_user;";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_user", $idUser);
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $abstractedObjects = [];
            foreach ($orders as $order)
                $abstractedObjects[] = Order::constructFromArray($order);

            return $abstractedObjects;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }

    /**
     * getOrderedVinyls
     *
     * @param  mixed $pdo
     * @param  mixed $orderId
     * @return array
     */
    public static function getOrderedVinyls($pdo, $orderId): array | null
    {
        try {
            $query = "select vinyls.id_vinyl, name, stock, price, style, duration, max_duration from vinyls inner join vinyls_ordered on vinyls_ordered.id_vinyl = vinyls.id_vinyl where vinyls_ordered.id_order=:id_order;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_order", $orderId);
            $stmt->execute();

            $queryResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $vinyls = [];
            foreach ($queryResults as $array)
                $vinyls[] = Vinyl::constructFromArray($array);

            return $vinyls;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }

    public static function getOrderId($pdo, $datetime)
    {
        try {
            $query = "select id_order from orders where date_time=:datetime order by id_order desc limit 1;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":datetime", $datetime);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }
}
