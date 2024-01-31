<?php

namespace VOST\models\database;

include_once 'Vinyl.php';
include_once 'Database.php';

use VOST\models\HasSongs;

class HasSongsModel
{

    public static function getHasSongs($pdo)
    {
        $tableName = "songs";
        $queryResults = Database::getItems($pdo, $tableName);

        foreach ($queryResults as $array)
            $abstractedObjects[] = HasSongs::constructFromArray($array);

        return $abstractedObjects;
    }

    public static function getHasSong($pdo, $hasSongs)
    {
        $queryResults = Database::getItem($pdo, $hasSongs);
        $abstractedObject = HasSongs::constructFromArray($queryResults);
        return $abstractedObject;
    }

    public static function deleteHasSong($pdo, $hasSongs)
    {
        $queryResults = Database::deleteItem($pdo, $hasSongs);
        return $queryResults;
    }

    public static function insertHasSong($pdo, $newHasSongs)
    {
        $queryResults = \VOST\models\database\Database::insertItem($pdo, $newHasSongs);
        return $queryResults;
    }

    public static function updateHasSong($pdo, $hasSongs)
    {
        $queryResults = Database::updateTable($pdo, $hasSongs);
        return $queryResults;
    }

}