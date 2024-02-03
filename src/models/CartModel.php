<?php

namespace VOST\models;

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
    public static function addToCart($pdo, $vinyl)
    {
        try {
            $query = "";
        } catch (PDOException $e) {
        } finally {
        }
    }

    public static function deleteFromCart($pdo, $vinyl)
    {
        try {
            $query = "";
        } catch (PDOException $e) {
        } finally {
        }
    }

    public static function deleteCart($pdo, $cartId)
    {
        // TODO: Aquí falta la clase del carrito, todo está a medias.
        return Database::deleteItem($pdo, $cartId);
    }
}
