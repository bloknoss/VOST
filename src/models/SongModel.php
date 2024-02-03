<?php

namespace VOST\models;

include_once __DIR__ . '/Song.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

use VOST\models\Song;
use VOST\models\database\DatabaseUtils;

class SongModel
{

    public static function getSongs($pdo)
    {
        $tableName = "songs";
        $queryResults = DatabaseUtils::getItems($pdo, $tableName);

        foreach ($queryResults as $array)
            $abstractedObjects[] = Song::constructFromArray($array);

        return $abstractedObjects;

    }

    public static function getSong($pdo, $song)
    {
        $queryResults = DatabaseUtils::getItem($pdo, $song);
        $abstractedObject = Song::constructFromArray($queryResults);
        return $abstractedObject;
    }

    public static function deleteSong($pdo, $song)
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $song);
        return $queryResults;
    }

    public static function insertSong($pdo, $newSong)
    {
        $queryResults = DatabaseUtils::insertItem($pdo, $newSong);
        return $queryResults;
    }

    public static function updateSong($pdo, $song)
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $song);
        return $queryResults;
    }

}