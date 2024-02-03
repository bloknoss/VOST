<?php

namespace VOST\models;

include_once __DIR__ . '/Vinyl.php';
include_once __DIR__ . '/Database.php';

use VOST\models\tables\VinylsOrdered;
use VOST\models\Database\DatabaseUtils;

class VinylsOrderedModel
{

    public static function getVinylsOrdered($pdo, $vinylsOrdered)
    {

        $tableName = "vinyls_ordered";
        $queryResults = DatabaseUtils::getItems($pdo, $tableName);
        foreach ($queryResults as $array)
            $abstractedObjects[] = VinylsOrdered::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getVinylOrdered($pdo, $vinylsOrdered)
    {
        $queryResults = DatabaseUtils::getItem($pdo, $vinylsOrdered);
        $abstractedObject = VinylsOrdered::constructFromArray($queryResults);
        return $abstractedObject;
    }

    public static function deleteVinylOrdered($pdo, $vinylsOrdered)
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $vinylsOrdered);
        return $queryResults;
    }

    public static function insertVinylOrdered($pdo, $newVinylsOrdered)
    {
        $queryResults = DatabaseUtils::insertItem($pdo, $newVinylsOrdered);
        return $queryResults;
    }

    public static function updateVinylOrdered($pdo, $vinylsOrdered)
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $vinylsOrdered);
        return $queryResults;
    }

}

