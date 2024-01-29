<?php

namespace VOST\models;

include_once __DIR__ . '/User.php';
include_once __DIR__ . '/Database.php';

use PHPMailer\PHPMailer\PHPMailer;
use VOST\models\User;
use VOST\models\Database;

class UserModel
{

    public static function getUsers($pdo, $user)
    {
        $tableName = $user->tableInfo['tableName'];
        $queryResults = Database::getItems($pdo, $tableName);
        $abstractedObjects = [];
        foreach ($queryResults as $array)
            $abstractedObjects[] = User::constructFromArray($array);

        return $abstractedObjects;

    }

    public static function getUser($pdo, $user):User|null
    {
        $queryResults = Database::getItem($pdo, $user);
        return User::constructFromArray($queryResults);
    }

    public static function deleteUser($pdo, $user)
    {
        $queryResults = Database::deleteItem($pdo, $user);
        return $queryResults;
    }

    public static function insertUser($pdo, $newUser)
    {
        $queryResults = Database::insertItem($pdo, $newUser);
        return $queryResults;
    }

    public static function updateUser($pdo, $user)
    {
        $queryResults = Database::updateTable($pdo, $user);
        return $queryResults;
    }

    public static function activateUser ($pdo, $user)
    {
        try{
            $id = $user->id_user;
            $query = "UPDATE users SET isActive=true WHERE id_user=:id";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->rowCount();
        }catch (PDOException $e){
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die(500);
        }
    }

}