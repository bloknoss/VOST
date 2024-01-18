<?php

namespace VOST\models;

use VOST\models\Utils;

use PDO;
use PDOException;


class Database
{
    public static function getItems($pdo, $tableName)
    {
        try {

            $query = "SELECT * FROM  $tableName;";

            $result = $pdo->query($query);

            $resultSet = $result->fetchAll(PDO::FETCH_ASSOC);
            return $resultSet;

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
    }

    public static function getItem($pdo, $item)
    {
        $idField = $item->tableInfo['tableFields'][0];
        $idValue = $item->tableInfo['tableValues']["$idField"];

        try {
            $query = "SELECT * FROM users WHERE $idField=:$idField";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(":$idField", $idValue);

            $stmt->execute();

            $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultSet;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
    }

    public static function deleteItem($pdo, $item)
    {
        try {

            $tableName = $item->tableInfo['tableName'];
            $fieldId = $item->tableInfo['tableFields'][0];
            $fieldValue = $item->tableInfo['tableValues'][$fieldId];

            echo $fieldId;

            $query = "DELETE from $tableName where $fieldId=:$fieldId";
            echo $query;

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(":$fieldId", $fieldValue);

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

    public static function insertItem($pdo, $newItem)
    {

        try {

            $query = Utils::generateInsertQuery($newItem);

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newItem);

            $stmt->execute();

            return $stmt->rowCount();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            echo ("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        } finally {
            $pdo = null;
        }
    }

    public static function updateTable($pdo, $item)
    {
        try {

            $query = Utils::generateUpdateQuery($item);

            echo $query;

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $item);

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



}
