<?php

namespace VOST\models\database;

include_once 'Vinyl.php';
include_once 'Database.php';

use VOST\models\VinylsOrdered;

class VinylsOrderedModel
{

    public static function getVinylsOrdered($pdo, $vinylsOrdered)
    {
        $tableName = $vinylsOrdered->tableInfo['tableName'];
        $queryResults = \VOST\models\database\Database::getItems($pdo, $tableName);
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
        $queryResults = \VOST\models\database\Database::insertItem($pdo, $newVinylsOrdered);
        return $queryResults;
    }

    public static function updateVinylOrdered($pdo, $vinylsOrdered)
    {
        $queryResults = \VOST\models\database\Database::updateTable($pdo, $vinylsOrdered);
        return $queryResults;
    }

}

