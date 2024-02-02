<?php

namespace VOST\models\database;

include_once 'Vinyl.php';
include_once 'Database.php';

use PDO;
use PDOException;
use VOST\models\Vinyl;

class VinylModel
{

    public static function getVinyls($pdo) : array
    {
        $tableName = "vinyls";
        $queryResults = Database::getItems($pdo, $tableName);
        foreach ($queryResults as $array)
            $abstractedObjects[] = Vinyl::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getVinyl($pdo, $vinyl) : Vinyl
    {
        $queryResults = \VOST\models\database\Database::getItem($pdo, $vinyl);
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
        $queryResults = \VOST\models\database\Database::insertItem($pdo, $newVinyl);
        return $queryResults;
    }

    public static function updateVinyl($pdo, $vinyl)
    {
        $queryResults = \VOST\models\database\Database::updateTable($pdo, $vinyl);
        return $queryResults;
    }

    public static function getVinylByName($pdo, $name) : Vinyl | null
    {
        try {

            $query = "DELETE from vinyls where name=:name;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":name", $name);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            echo ("An error has occured while executing the SQL query in the database." . $e->getMessage());
        } finally {
            $pdo = null;
            return null;
        }
    }

    public static function getSongs($pdo, $vinylId) : array
    {
        try {
            $query = "select * from vinyls inner join has_songs on has_songs.id_vinyl=vinyls.id_vinyl where vinyls.id_vinyl=:id_vinyl";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_vinyl", $vinylId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            echo ("An error has occured while executing the SQL query in the database." . $e->getMessage());
        } finally {
            $pdo = null;
            return [-1];
        }
    }


}