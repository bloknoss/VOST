<?php

namespace VOST\models;

include_once 'Vinyl.php';
include_once 'Database.php';

use VOST\models\VinylsOrdered;
use VOST\models\Database;

class VinylsOrderedModel
{

    public static function getVinylsOrdered($pdo, $vinylsOrdered)
    {
        $tableName = $vinylsOrdered->tableInfo['tableName'];
        $queryResults = Database::getItems($pdo, $tableName);
        foreach ($queryResults as $array)
            $abstractedObjects[] = VinylsOrdered::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getVinylOrdered($pdo, $vinylsOrdered)
    {
        $queryResults = Database::getItem($pdo, $vinylsOrdered);
        $abstractedObject = VinylsOrdered::constructFromArray($queryResults);
        return $abstractedObject;
    }

    public static function deleteVinylOrdered($pdo, $vinylsOrdered)
    {
        $queryResults = Database::deleteItem($pdo, $vinylsOrdered);
        return $queryResults;
    }

    public static function insertVinylOrdered($pdo, $newVinylsOrdered)
    {
        $queryResults = Database::insertItem($pdo, $newVinylsOrdered);
        return $queryResults;
    }

    public static function updateVinylOrdered($pdo, $vinylsOrdered)
    {
        $queryResults = Database::updateTable($pdo, $vinylsOrdered);
        return $queryResults;
    }

}

