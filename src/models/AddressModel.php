<?php

namespace VOST\models;

use VOST\models\tables\Address;
use VOST\models\database\DatabaseUtils;

include_once __DIR__ . '/tables/Address.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

use PDO;
use PDOException;
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
     * getUserAddresses
     *
     * @param  mixed $pdo
     * @param  mixed $idUser
     * @return array
     */
    public static function getUserAddresses($pdo, $idUser): array|null
    {
        try {
            $query = "select id_address, postal_code, city, street, number, addresses.id_user from addresses inner join users on users.id_user=addresses.id_user where users.id_user=:id_user;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_user", $idUser);
            $stmt->execute();

            $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $abstractedObjects = [];

            foreach ($addresses as $address)
                $abstractedObjects[] = Address::constructFromArray($address);

            return $abstractedObjects;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
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
