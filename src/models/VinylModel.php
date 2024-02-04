<?php

namespace VOST\models;

include_once __DIR__ . '/tables/Vinyl.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

use PDO;
use PDOException;
use VOST\models\tables\Vinyl;
use VOST\models\database\DatabaseUtils;

class VinylModel
{
    
    /**
     * getVinyls
     *
     * @param  mixed $pdo
     * @return array
     */
    public static function getVinyls($pdo): array
    {
        $tableName = "vinyls";
        $queryResults = DatabaseUtils::getItems($pdo, $tableName);
        foreach ($queryResults as $array)
            $abstractedObjects[] = Vinyl::constructFromArray($array);

        return $abstractedObjects;
    }
    
    /**
     * getVinyl
     *
     * @param  mixed $pdo
     * @param  mixed $vinyl
     * @return Vinyl
     */
    public static function getVinyl($pdo, $vinyl): Vinyl|null
    {
        $queryResults = DatabaseUtils::getItem($pdo, $vinyl);
        $abstractedObject = Vinyl::constructFromArray($queryResults);
        return $abstractedObject;
    }
    
    /**
     * deleteVinyl
     *
     * @param  mixed $pdo
     * @param  mixed $vinyl
     * @return int
     */
    public static function deleteVinyl($pdo, $vinyl): int
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $vinyl);
        return $queryResults;
    }
    
    /**
     * insertVinyl
     *
     * @param  mixed $pdo
     * @param  mixed $newVinyl
     * @return int
     */
    public static function insertVinyl($pdo, $newVinyl): int
    {
        $queryResults = DatabaseUtils::insertItem($pdo, $newVinyl);
        return $queryResults;
    }
    
    /**
     * updateVinyl
     *
     * @param  mixed $pdo
     * @param  mixed $vinyl
     * @return int
     */
    public static function updateVinyl($pdo, $vinyl): int
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $vinyl);
        return $queryResults;
    }
    
    /**
     * getVinylByName
     *
     * @param  mixed $pdo
     * @param  mixed $name
     * @return Vinyl
     */
    public static function getVinylByName($pdo, $name): Vinyl | null
    {
        try {

            $query = "DELETE from vinyls where name=:name;";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":name", $name);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }
    
    /**
     * getSongs
     *
     * @param  mixed $pdo
     * @param  mixed $vinylId
     * @return array
     */
    public static function getSongs($pdo, $vinylId): array | null
    {
        try {
            $query = "select songs.artist as artist, songs.compositor as compositor, songs.name as name, songs.genre as genre, songs.duration as duration from vinyls inner join has_songs on has_songs.id_vinyl=vinyls.id_vinyl inner join songs on has_songs.id_song = songs.id_song where vinyls.id_vinyl=:id_vinyl";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_vinyl", $vinylId);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return null;
        } finally {
            $pdo = null;
        }
    }
}
