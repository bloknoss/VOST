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
    public static function getUserOrders($pdo, $idUser): array | null
    {
        try {
            $query = "select orders.id_order, orders.date_time, orders.id_address from orders inner join address on address.id_address=orders.id_address inner join users on users.id_user=address.id_user where users.id_user=:id_user;";

            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_user", $idUser);
            $stmt->execute();

            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $abstractedObjects = [];
            foreach ($orders as $order)
                $abstractedObjects[] = Order::constructFromArray($order);


            return $abstractedObjects;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
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
            $query = "select id_address, postal_code, city, street, number, address.id_user from address inner join users on users.id_user=address.id_user where users.id_user=:id_user;";
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
