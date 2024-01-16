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
            $query = "SELECT * FROM  address;";

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
            $query = "SELECT * FROM address WHERE id_address=:id_address";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':id_address', $addressId);

            $stmt->execute();

            $resultSet = $stmt->fetchAll();
            
            return $resultSet;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
    }

    public static function deleteAddress($pdo, $addressId)
    {
        try {
            $query = "DELETE from address where id_address=:id_address";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':id_address', $addressId);

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

            $query = "INSERT INTO address (id_address,id_user,postal_code,city,street,number) VALUES (:id_address,:id_user,:postal_code,:city,:street,:number)";

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

            $query = Utils::generateUpdateQuery($newAddress, "address", $tableFields);

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