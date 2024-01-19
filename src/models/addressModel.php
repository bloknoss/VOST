<?php

namespace VOST\models;

include_once 'address.php';
include_once 'database.php';

use VOST\models\Address;
use VOST\models\Database;

class AddressModel
{

    public static function getAddresses($pdo, $address)
    {
        $tableName = $address->tableInfo['tableName'];
        $queryResults = Database::getItems($pdo, $tableName);
        $abstractedObjects = [];
        foreach ($queryResults as $array)
            $abstractedObjects[] = Address::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getAddress($pdo, $address)
    {
        $queryResults = Database::getItem($pdo, $address);
        $abstractedObject = Address::constructFromArray($queryResults);
        return $abstractedObject;
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