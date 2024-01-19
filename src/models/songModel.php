<?php

namespace VOST\models;

include_once 'song.php';
include_once 'database.php';

use VOST\models\Song;
use VOST\models\Database;

class SongModel
{

    public static function getSongs($pdo, $song)
    {
        $tableName = $song->tableInfo['tableName'];
        $queryResults = Database::getItems($pdo, $tableName);

        foreach ($queryResults as $array)
            $abstractedObjects[] = Song::constructFromArray($array);

        return $abstractedObjects;

    }

    public static function getSong($pdo, $song)
    {
        $queryResults = Database::getItem($pdo, $song);
        $abstractedObject = Song::constructFromArray($queryResults);
        return $abstractedObject;
    }

    public static function deleteSong($pdo, $song)
    {
        $queryResults = Database::deleteItem($pdo, $song);
        return $queryResults;
    }

    public static function insertSong($pdo, $newSong)
    {
        $queryResults = Database::insertItem($pdo, $newSong);
        return $queryResults;
    }

    public static function updateSong($pdo, $song)
    {
        $queryResults = Database::updateTable($pdo, $song);
        return $queryResults;
    }

}