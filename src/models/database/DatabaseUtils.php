<?php

namespace VOST\models\database;

include_once __DIR__ . '/QueryUtils.php';

use PDO;
use PDOException;


class DatabaseUtils
{
    /**
     * dbConnect
     *
     * @return PDO
     */
    public static function dbConnect(): PDO
    {
        $config = include(__DIR__ . "/../../config.php");
        $config = $config["db"];

        // Sacamos las variables del archivo de configuración fuera para evitar añadir demasiado código más adelante
        $dbname = $config["dbname"];
        $hostname = $config["hostname"];

        // Establecemos una conexión con el PDO haciendo uso de las variables de conexión.
        try {
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $config["username"], $config["password"]);
        } catch (PDOException $e) {
            error_log("An error has occured while establishing a connection with the database." . $e->getMessage());
        }

        return $pdo;
    }

    /**
     * getItems
     *
     * @param  mixed $pdo
     * @param  mixed $tableName
     * @return array
     */
    public static function getItems($pdo, $tableName): array | null
    {
        try {

            $query = "SELECT * FROM  $tableName;";

            $result = $pdo->query($query);
            $resultSet = $result->fetchAll(PDO::FETCH_ASSOC);

            return $resultSet;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }

    /**
     * getItem
     *
     * @param  mixed $pdo
     * @param  mixed $item
     * @return array
     */
    public static function getItem($pdo, $item): array | null
    {

        try {
            $idField = $item->tableInfo['tableFields'][0];
            $idValue = $item->tableInfo['tableValues']["$idField"];
            $tableName = $item->tableInfo['tableName'];

            $query = "SELECT * FROM $tableName WHERE $idField=:$idField";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(":$idField", $idValue);

            $stmt->execute();

            $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultSet;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }

    /**
     * deleteItem
     *
     * @param  mixed $pdo
     * @param  mixed $item
     * @return int
     */
    public static function deleteItem($pdo, $item): int | null
    {
        try {

            $tableName = $item->tableInfo['tableName'];
            $fieldId = $item->tableInfo['tableFields'][0];
            $fieldValue = $item->tableInfo['tableValues'][$fieldId];

            $query = "DELETE from $tableName where $fieldId=:$fieldId;";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(":$fieldId", $fieldValue);

            $stmt->execute();

            $affectedRows = $stmt->rowCount();

            return $affectedRows;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }


    /**
     * insertItem
     *
     * @param  mixed $pdo
     * @param  mixed $newItem
     * @return int
     */
    public static function insertItem($pdo, $newItem): int | null
    {
        try {

            $query = QueryUtils::generateInsertQuery($newItem);

            $stmt = $pdo->prepare($query);

            $stmt = QueryUtils::statementValueBinder($stmt, $newItem);

            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }

    /**
     * insertIntermediaryItem
     *
     * @param  mixed $pdo
     * @param  mixed $newItem
     * @return int
     */
    public static function insertIntermediaryItem($pdo, $newItem): int | null
    {
        try {

            $query = QueryUtils::generateIntermediaryInsertQuery($newItem);

            $stmt = $pdo->prepare($query);

            $stmt = QueryUtils::statementValueBinder($stmt, $newItem);
            var_dump($stmt);

            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }

    /**
     * updateTable
     *
     * @param  mixed $pdo
     * @param  mixed $item
     * @return int
     */
    public static function updateTable($pdo, $item): int | null
    {
        try {

            $query = QueryUtils::generateUpdateQuery($item);
            $stmt = $pdo->prepare($query);
            $stmt = QueryUtils::statementValueBinder($stmt, $item);
            $stmt->execute();

            return  $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }
}
