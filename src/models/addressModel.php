<?php

namespace VOST\models;

include_once 'address.php';
include_once 'database.php';

use PDO;
use PDOException;
use VOST\models\Address;
use VOST\models\Utils;
use VOST\models\Database;

class AddressModel
{

    public static function getAddresses($pdo, $address)
    {
        $tableName = $address->tableInfo['tableName'];
        $queryResults = Database::getItems($pdo, $tableName);
        return $queryResults;
    }

    public static function getAddress($pdo, $address)
    {
        $queryResults = Database::getItem($pdo, $address);
        return $queryResults;
    }

    public static function deleteAddress($pdo, $address)
    {
        $queryResults = Database::deleteItem($pdo, $address);
        return $queryResults;
    }

    public static function insertAddress($pdo, $newAddress)
    {
        $queryResults = Database::insertItem($pdo, $newAddress);
        return $queryResults;
    }

    public static function updateAddress($pdo, $address)
    {
        $queryResults = Database::updateTable($pdo, $address);
        return $queryResults;
    }

}