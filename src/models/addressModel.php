<?php

namespace VOST;

use VOST\model\Utils;
use PDOException;

class AddressModel
{

    private $tableFields = ['id_address', 'id_user', 'postal_code', 'city', 'street', 'number'];
    public static function getAddresses($pdo)
    {
        try {
            $query = "SELECT * FROM  ADDRESSES";

            $result = $pdo->query($query);

            $resultSet = $result->fetchAll();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function getAddress($pdo, $addressId)
    {
        try {
            $query = "SELECT * FROM  ADDRESSES WHERE address_id=:address_id";

            $result = $pdo->query($query);

            $stmt = $pdo->prepare($query);
            
            $stmt->bindValue(':address_id', $addressId);

            $resultSet = $result->fetchAll();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function deleteAddress($pdo, $addressId)
    {
        try {
            $query = "DELETE from ADDRESSES where address_id=:address_id";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':address_id', $addressId);

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

    public static function insertAddress($pdo, $newAddress)
    {

        $tableFields = ['id_address', 'id_user', 'postal_code', 'city', 'street', 'number'];

        try {

            $query = "INSERT INTO ADDRESSES (id_address,id_user,postal_code,city,street,number) VALUES (:id_address,:id_user,:postal_code,:city,:street,:number)";

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newAddress, $tableFields);

            $stmt->execute();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return -1;
        } finally {
            $pdo = null;
        }
    }

    public static function updateAddress($pdo, $newAddress)
    {
        try {

            if (count($newAddress) == 0)
                return -1;

            $tableFields = ['id_address', 'id_user', 'postal_code', 'city', 'street', 'number'];

            $query = Utils::generateUpdateQuery($newAddress, "ADDRESSES", $tableFields);

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newAddress, $tableFields);

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