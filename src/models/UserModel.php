<?php

namespace VOST\models;

use VOST\models\database\DatabaseUtils;
use VOST\models\tables\User;
use VOST\models\tables\Order;
use VOST\models\tables\Address;

include_once __DIR__ . '/tables/User.php';
include_once __DIR__ . '/tables/Order.php';
include_once __DIR__ . '/tables/Address.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

use PDO;
use PDOException;

class UserModel
{
    /**
     * getUsers
     *
     * @param  mixed $pdo
     * @return array
     */
    public static function getUsers($pdo): array
    {
        $tableName = "users";
        $queryResults = DatabaseUtils::getItems($pdo, $tableName);
        $users = [];
        foreach ($queryResults as $array)
            $users[] = User::constructFromArray($array);

        return $users;
    }

    /**
     * getUser
     *
     * @param  mixed $pdo
     * @param  mixed $user
     * @return User
     */
    public static function getUser($pdo, $user): User|null
    {
        $queryResults = DatabaseUtils::getItem($pdo, $user);
        $user = User::constructFromArray($queryResults);
        return $user;
    }

    /**
     * deleteUser
     *
     * @param  mixed $pdo
     * @param  mixed $user
     * @return int
     */
    public static function deleteUser($pdo, $user): int
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $user);
        return $queryResults;
    }

    /**
     * insertUser
     *
     * @param  mixed $pdo
     * @param  mixed $newUser
     * @return int
     */
    public static function insertUser($pdo, $newUser): int
    {
        $queryResults = DatabaseUtils::insertItem($pdo, $newUser);
        return $queryResults;
    }

    /**
     * updateUser
     *
     * @param  mixed $pdo
     * @param  mixed $user
     * @return int
     */
    public static function updateUser($pdo, $user): int
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $user);
        return $queryResults;
    }

    /**
     * getUserByEmail
     *
     * @param  mixed $pdo
     * @param  mixed $email
     * @return User
     */
    public static function getUserByEmail($pdo, $email): User | null
    {
        try {
            $query = "select * from users where email=:email";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            return User::constructFromArray($stmt->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }

    /**
     * getUserOrders
     *
     * @param  mixed $pdo
     * @param  mixed $idUser
     * @return array
     */



    /**
     * getUserByName
     *
     * @param  mixed $pdo
     * @param  mixed $name
     * @return User
     */
    public static function getUserByName($pdo, $name): User|null
    {
        try {

            $query = "select * from users where name=:name";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':name', $name);
            $stmt->execute();
            return User::constructFromArray($stmt->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }
}
