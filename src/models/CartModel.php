<?php

namespace VOST\models;

use PDO;
use PDOException;
use VOST\models\tables\CartVinyls;
use VOST\models\database\DatabaseUtils;
use VOST\models\tables\Vinyl;
use VOST\models\VinylItem;


include_once __DIR__ . '/database/DatabaseUtils.php';
include_once __DIR__ . '/tables/CartVinyls.php';
include_once __DIR__ . '/VinylItem.php';
class CartModel
{

    /**
     * getCartVinyls
     *
     * @param  mixed $pdo
     * @param  mixed $userId
     * @return array
     */
    public static function getCartVinyls($pdo, $userId): array | null
    {
        try {
            $query = "SELECT vinyls.id_vinyl, name, stock, price, style, duration, max_duration, cv.quantity FROM vinyls INNER JOIN vostdb.carts_vinyls cv on vinyls.id_vinyl = cv.id_vinyl where id_user =:id_user;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_user", $userId);
            $stmt->execute();

            $queryResults = $stmt->fetchAll(PDO::FETCH_ASSOC);


            $cartVinyls = [];
            foreach ($queryResults as $cartVinyl){
                $lastItem = array_splice($cartVinyl,-1 );
                $cartVinyls[] = new VinylItem(Vinyl::constructFromArray($cartVinyl), $lastItem["quantity"]);
            }

            return $cartVinyls;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }

    /**
     * getCartVinyl
     *
     * @param  mixed $pdo
     * @param  mixed $userId
     * @param  mixed $vinylId
     * @return CartVinyls
     */
    public static function getCartVinyl($pdo, $userId, $vinylId): CartVinyls | null
    {
        try {
            $query = "SELECT * FROM carts_vinyls WHERE id_user=:id_user AND id_vinyl=:id_vinyl;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_user", $userId);
            $stmt->bindValue(":id_vinyl", $vinylId);
            $stmt->execute();

            return CartVinyls::constructFromArray($stmt->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }


    /**
     * addVinylToCart
     *
     * @param  mixed $pdo
     * @param  mixed $cartVinyls
     * @return int
     */
    public static function addVinylToCart($pdo, $cartVinyls): int
    {
        return DatabaseUtils::insertIntermediaryItem($pdo, $cartVinyls);
    }

    /**
     * updateVinylQuantity
     *
     * @param  mixed $pdo
     * @param  mixed $cartVinyl
     * @return int
     */
    public static function updateVinylQuantity($pdo, $cartVinyl): int | null
    {
        try {
            $query = "UPDATE carts_vinyls SET quantity=:quantity WHERE id_user=:id_user AND id_vinyl=:id_vinyl";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_user", $cartVinyl->id_user);
            $stmt->bindValue(":id_vinyl", $cartVinyl->id_vinyl);
            $stmt->bindValue(":quantity", $cartVinyl->quantity);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }

    /**
     * deleteFromCart
     *
     * @param  mixed $pdo
     * @param  mixed $userId
     * @param  mixed $vinylId
     * @return int
     */
    public static function deleteFromCart($pdo, $userId, $vinylId): int | null
    {
        try {
            $query = "DELETE FROM carts_vinyls WHERE id_user=:id_user AND id_vinyl=:id_vinyl;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_user", $userId);
            $stmt->bindValue(":id_vinyl", $vinylId);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }

    /**
     * deleteCart
     *
     * @param  mixed $pdo
     * @param  mixed $userId
     * @return int
     */
    public static function deleteCart($pdo, $userId): int | null
    {
        try {
            $query = "DELETE FROM carts_vinyls WHERE id_user=:id_user;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_user", $userId);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }
}
