<?php

namespace VOST\models;

include_once __DIR__ . '/User.php';
include_once __DIR__ . '/Database.php';

use PDO;
use PDOException;

class UserModel
{

    public static function getUsers($pdo)
    {
        $tableName = "users";
        $queryResults = Database::getItems($pdo, $tableName);
        $abstractedObjects = [];
        foreach ($queryResults as $array)
            $abstractedObjects[] = User::constructFromArray($array);

        return $abstractedObjects;

    }

    //Mi forma de get User
    public static function getUser($pdo, $user): User|null
    {
        $queryResults = Database::getItem($pdo, $user);
        $user = User::constructFromArray($queryResults);
        unset($user->tableInfo);
        return $user;
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

    //Mi forma de la function
    public static function getUserByEmail($pdo, $email)
    {
        $pdo = Utils::dbConnect();
        $user = new User(null, null, $email, null);
        $user->tableInfo['tableFields'][0] = 'email';
        return Database::getItem($pdo, $user);
    }

    public static function getUserByName($pdo, $name)
    {
        try {

            $query = "select * from users where name=:name";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':name', $name);
            $stmt->execute();
            return User::constructFromArray($stmt->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {

        }
    }

    public static function activateUser($pdo, $user)
    {
        try {
            $id = $user->id_user;
            $query = "UPDATE users SET is_active=true WHERE id_user=:id";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die(500);
        }
    }

}