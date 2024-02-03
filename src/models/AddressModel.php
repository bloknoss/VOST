<?php

namespace VOST\models;
use VOST\models\tables\Address;
use VOST\models\database\DatabaseUtils;

include_once __DIR__ . '/Address.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

class AddressModel
{

    public static function getAddresses($pdo)
    {
        $tableName = "addresses";
        $queryResults = DatabaseUtils::getItems($pdo, $tableName);
        $abstractedObjects = [];
        foreach ($queryResults as $array)
            $abstractedObjects[] = Address::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getAddress($pdo, $address)
    {
        $queryResults = DatabaseUtils::getItem($pdo, $address);
        $abstractedObject = Address::constructFromArray($queryResults);
        return $abstractedObject;
    }

    public static function deleteAddress($pdo, $address)
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $address);
        return $queryResults;
    }

    public static function insertAddress($pdo, $newAddress)
    {
        $queryResults = DatabaseUtils::insertItem($pdo, $newAddress);
        return $queryResults;
    }

    public static function updateAddress($pdo, $address)
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $address);
        return $queryResults;
    }

}