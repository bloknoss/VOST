<?php

namespace VOST;

use VOST\model\Utils;
use PDOException;

class OrderModel
{

    private $tableFields = ['id_order', 'id_address', 'date_time'];
    public static function getOrders($pdo)
    {
        try {
            $query = "SELECT * FROM  ORDERS";

            $result = $pdo->query($query);

            $resultSet = $result->fetchAll();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function getOrder($pdo, $orderId)
    {
        try {
            $query = "SELECT * FROM  ORDERS WHERE order_id=:order_id";

            $result = $pdo->query($query);

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':order_id', $orderId);

            $resultSet = $result->fetchAll();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function deleteOrder($pdo, $orderId)
    {
        try {
            $query = "DELETE from ORDERS where order_id=:order_id";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':order_id', $orderId);

            $stmt->execute();

            $affectedRows = $stmt->rowCount();

            return $affectedRows;

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        } finally {
            $pdo = null;
        }
    }

    public static function insertOrder($pdo, $newOrder)
    {
        $tableFields = ['id_order', 'id_address', 'date_time'];


        try {

            $query = "INSERT INTO ORDERS (id_order,id_address,date_time) VALUES (:id_order,:id_address,:date_time)";

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newOrder, $tableFields);

            $stmt->execute();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return -1;
        } finally {
            $pdo = null;
        }
    }

    public static function updateOrder($pdo, $newOrder)
    {
        try {

            if (count($newOrder) == 0)
                return -1;
            $tableFields = ['id_order', 'id_address', 'date_time'];


            $query = Utils::generateUpdateQuery($newOrder, "ORDERS", $tableFields);

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newOrder, $tableFields);

            $stmt->execute();

            $affectedRows = $stmt->rowCount();

            return $affectedRows;

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return -1;
        } finally {
            $pdo = null;
        }
    }

}