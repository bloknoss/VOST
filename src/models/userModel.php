<?php

namespace VOST;

use VOST\model\Utils;
use PDOException;

class UserModel
{

    private $tableFields = ['id_user', 'name', 'email', 'password'];
    public static function getUsers($pdo)
    {
        try {
            $query = "SELECT * FROM  users;";

            $result = $pdo->query($query);

            $resultSet = $result->fetchAll();

            return $resultSet;

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
    }

    public static function getUser($pdo, $userId)
    {
        try {
            $query = "SELECT * FROM users WHERE id_user=:id_user";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':id_user', $userId);

            $stmt->execute();

            $resultSet = $stmt->fetchAll();

            return $resultSet;
        } catch (PDOException $e) {
            echo ("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
    }

    public static function deleteUser($pdo, $userId)
    {
        try {
            $query = "DELETE from users where id_user=:id_user";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':id_user', $userId);

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

        $tableFields = ['id_user', 'name', 'email', 'password'];

        try {

            $query = "INSERT INTO productos (id_user,name,email,password) VALUES (:id_user,:name,:email,:password);";

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

            $tableFields = ['id_user', 'name', 'email', 'password'];

            $query = Utils::generateUpdateQuery($newUser, "users", $tableFields);

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