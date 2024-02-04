<?php

namespace VOST\models;

use VOST\models\tables\Address;
use VOST\models\database\DatabaseUtils;

include_once __DIR__ . '/tables/Address.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

class AddressModel
{
    
    /**
     * getAddresses
     *
     * @param  mixed $pdo
     * @return array
     */
    public static function getAddresses($pdo): array
    {
        $queryResults = DatabaseUtils::getItems($pdo, "addresses");
        $addresses = [];
        foreach ($queryResults as $array)
            $addresses[] = Address::constructFromArray($array);

        return $addresses;
    }
    
    /**
     * getAddress
     *
     * @param  mixed $pdo
     * @param  mixed $address
     * @return Address
     */
    public static function getAddress($pdo, $address): Address
    {
        $queryResults = DatabaseUtils::getItem($pdo, $address);
        return Address::constructFromArray($queryResults);
    }
    
    /**
     * deleteAddress
     *
     * @param  mixed $pdo
     * @param  mixed $address
     * @return int
     */
    public static function deleteAddress($pdo, $address): int
    {
        return DatabaseUtils::deleteItem($pdo, $address);
    }
    
    /**
     * insertAddress
     *
     * @param  mixed $pdo
     * @param  mixed $newAddress
     * @return int
     */
    public static function insertAddress($pdo, $newAddress): int
    {
        return  DatabaseUtils::insertItem($pdo, $newAddress);
    }
    
    /**
     * updateAddress
     *
     * @param  mixed $pdo
     * @param  mixed $address
     * @return int
     */
    public static function updateAddress($pdo, $address) : int
    {
        return  DatabaseUtils::updateTable($pdo, $address);
    }
}
