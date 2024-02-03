<?php

namespace VOST\models;

use PDO;
use PDOException;

include_once 'Database.php';

class CartModel
{

    public static function getCartItems($pdo, $cartId): array | null
    {
        $reqResults = Database::getItems($pdo, "carts");
        //TODO: Crear la clase abstracta de el carrito, una vez hecho devolver la clase construida.
        return $reqResults;
    }

    // TODO: Falta tener información de la base de datos.
    public static function addVinylToCart($pdo, $cartId, $vinylId)
    {

        try {
            $query = "INSERT INTO carts_vinyls (cart_id, vinyl_id) VALUES (:cart_id, :vinyl_id)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_cart", $cartId);
            $stmt->bindValue(":id_vinyl", $vinylId);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
        } finally {
        }
    }

    public static function deleteFromCart($pdo, $cartId, $vinylId)
    {
        try {
            $query = "DELETE FROM carts_vinyls WHERE id_cart=:id_cart AND id_vinyl=:id_vinyl;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_cart", $cartId);
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
