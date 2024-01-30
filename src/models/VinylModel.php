<?php

namespace VOST\models;

include_once 'Vinyl.php';
include_once 'Database.php';

use PDO;
use PDOException;
use VOST\models\Vinyl;
use VOST\models\Database;

class VinylModel
{

    public static function getVinyls($pdo)
    {
        $tableName = "vinyls"; 
        $queryResults = Database::getItems($pdo, $tableName);
        foreach ($queryResults as $array)
            $abstractedObjects[] = Vinyl::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getVinyl($pdo, $vinyl)
    {
        $queryResults = Database::getItem($pdo, $vinyl);
        $abstractedObject = Vinyl::constructFromArray($queryResults);
        return $abstractedObject;

    }

    public static function deleteVinyl($pdo, $vinyl)
    {
        $queryResults = Database::deleteItem($pdo, $vinyl);
        return $queryResults;
    }

    public static function insertVinyl($pdo, $newVinyl)
    {
        $queryResults = Database::insertItem($pdo, $newVinyl);
        return $queryResults;
    }

    public static function updateVinyl($pdo, $vinyl)
    {
        $queryResults = Database::updateTable($pdo, $vinyl);
        return $queryResults;
    }

    public static function getVinylByName()
    {
        try {



        } catch (PDOException $e) {

        }
    }

    public static function getOrderedVinyls($pdo, $orderId)
    {
        try {
            $query = "select vinyls.id_vinyl, name, stock, price, style, duration, max_duration from vinyls inner join vinyls_ordered on vinyls_ordered.id_vinyl = vinyls.id_vinyl where vinyls_ordered.id_order=:id_order;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_order", $orderId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public static function getHasSongs($pdo, $vinylId)
    {
        try {
            $query = "select * from vinyls inner join has_songs on has_songs.id_vinyl=vinyls.id_vinyl where vinyls.id_vinyl=:id_vinyl";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_vinyl", $vinylId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }


}