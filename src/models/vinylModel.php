<?php

namespace VOST;

use VOST\model\Utils;
use PDOException;

class UserModel
{

    private $tableFields = ['id_vinyl', 'stock','price','style','duration','max_duration'];
    public static function getUsers($pdo)
    {
        try {
            $query = "SELECT * FROM  USERS";

            $result = $pdo->query($query);

            $resultSet = $result->fetchAll();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function getUser($pdo, $userId)
    {
        try {
            $query = "SELECT * FROM  USERS WHERE user_id=:user_id";

            $result = $pdo->query($query);

            $stmt = $pdo->prepare($query);
            
            $stmt->bindValue(':user_id', $userId);

            $resultSet = $result->fetchAll();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function deleteUser($pdo, $userId)
    {
        try {
            $query = "DELETE from USERS where user_id=:user_id";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':user_id', $userId);

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

    public static function insertUser($pdo, $newUser)
    {

        $tableFields = ['id_vinyl', 'stock','price','style','duration','max_duration'];

        try {

            $query = "INSERT INTO USERS (id_vinyl,stock,price,style,duration,max_duration) VALUES (:id_vinyl,:stock,:price,:style,:duration,:max_duration)";

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newUser, $tableFields);

            $stmt->execute();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return -1;
        } finally {
            $pdo = null;
        }
    }

    public static function updateUser($pdo, $newUser)
    {
        try {

            if (count($newUser) == 0)
                return -1;

            $tableFields = ['id_vinyl', 'stock','price','style','duration','max_duration'];

            $query = Utils::generateUpdateQuery($newUser, "USERS", $tableFields);

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newUser, $tableFields);

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