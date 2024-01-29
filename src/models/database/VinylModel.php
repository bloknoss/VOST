<?php

namespace VOST\models\database;

include_once 'Vinyl.php';
include_once 'Database.php';

use VOST\models\Vinyl;

class VinylModel
{

    public static function getVinyls($pdo, $vinyl)
    {
        $tableName = $vinyl->tableInfo['tableName'];
        $queryResults = Database::getItems($pdo, $tableName);
        foreach ($queryResults as $array)
            $abstractedObjects[] = Vinyl::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getVinyl($pdo, $vinyl)
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

}