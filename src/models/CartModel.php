<?php

namespace VOST\models;

use PDO;
use PDOException;

include_once 'Database.php';

class CartModel
{

    public static function getCartVinyls($pdo, $cartId): array | null
    {

        //TODO: Crear la clase abstracta de el carrito, una vez hecho devolver la clase construida.
        return $reqResults;
    }

    // TODO: Falta tener información de la base de datos.
    public static function addVinylToCart($pdo, $cartId, $vinylId)
    {

        try {
            $query = "INSERT INTO carts_vinyls (id_user, id_vinyl) VALUES (:id_user, :id_vinyl)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_cart", $cartId);
            $stmt->bindValue(":id_vinyl", $vinylId);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
        } finally {
        }
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
        return Database::deleteItem($pdo, $cart);
    }
}
