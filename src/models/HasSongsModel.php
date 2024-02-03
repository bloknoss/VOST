<?php

namespace VOST\models;

include_once __DIR__ . '/tables/Vinyl.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

use VOST\models\tables\HasSongs;
use VOST\models\database\DatabaseUtils;

class HasSongsModel
{

    public static function getHasSongs($pdo)
    {
        $tableName = "songs";
        $queryResults = DatabaseUtils::getItems($pdo, $tableName);

        foreach ($queryResults as $array)
            $abstractedObjects[] = HasSongs::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getHasSong($pdo, $hasSongs)
    {
        $queryResults = DatabaseUtils::getItem($pdo, $hasSongs);
        $abstractedObject = HasSongs::constructFromArray($queryResults);
        return $abstractedObject;
    }

    public static function deleteHasSong($pdo, $hasSongs)
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $hasSongs);
        return $queryResults;
    }

    public static function insertHasSong($pdo, $newHasSongs)
    {
        $queryResults = DatabaseUtils::insertItem($pdo, $newHasSongs);
        return $queryResults;
    }

    public static function updateHasSong($pdo, $hasSongs)
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $hasSongs);
        return $queryResults;
    }
}
