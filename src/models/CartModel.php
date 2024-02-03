<?php

namespace VOST\models;

use PDO;
use PDOException;
use VOST\models\tables\CartVinyls;
use VOST\models\database\DatabaseUtils;

include_once __DIR__ . '/database/DatabaseUtils.php';
include_once __DIR__ . '/CartVinyls.php';

class CartModel
{

    public static function getCartVinyls($pdo): array | null
    {
        $queryResults = DatabaseUtils::getItems($pdo, "cart_vinyls");
        $cartVinyls = [];
        foreach ($queryResults as $array)
            $cartVinyls[] = CartVinyls::constructFromArray($array);

        return $cartVinyls;
    }


    public static function addVinylToCart($pdo, $cartVinyls)
    {
        return DatabaseUtils::insertItem($pdo, $cartVinyls);
    }

    public static function deleteFromCart($pdo, $userId, $vinylId)
    {
        try {
            $query = "DELETE FROM carts_vinyls WHERE id_user=:id_user AND id_vinyl=:id_vinyl;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_user", $userId);
            $stmt->bindValue(":id_vinyl", $vinylId);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
        } finally {
        }
    }

    public static function deleteCart($pdo, $cart)
    {
        return DatabaseUtils::deleteItem($pdo, $cart);
    }
}
