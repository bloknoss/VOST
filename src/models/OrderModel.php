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
}
