<?php

namespace VOST\models;

include_once 'user.php';
include_once 'database.php';

use PDO;
use PDOException;
use VOST\models\User;
use VOST\models\Utils;
use VOST\models\Database;

class UserModel
{

    public static function getUsers($pdo, $user)
    {
        $tableName = $user->tableInfo['tableName'];
        $queryResults = Database::getItems($pdo, $tableName);
        return $queryResults;
    }

    public static function getUser($pdo, $user)
    {
        $queryResults = Database::getItem($pdo, $user);
        return $queryResults;
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

}