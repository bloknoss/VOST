<?php

namespace VOST\models;

include_once __DIR__ . '/tables/Song.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

use VOST\models\tables\Song;
use VOST\models\database\DatabaseUtils;

class SongModel
{

    /**
     * getSongs
     *
     * @param  mixed $pdo
     * @return array
     */
    public static function getSongs($pdo): array
    {
        $queryResults = DatabaseUtils::getItems($pdo, "songs");

        $songs = [];

        foreach ($queryResults as $array)
            $songs[] = Song::constructFromArray($array);

        return $songs;
    }

    /**
     * getSong
     *
     * @param  mixed $pdo
     * @param  mixed $song
     * @return Song
     */
    public static function getSong($pdo, $song): Song
    {
        $queryResults = DatabaseUtils::getItem($pdo, $song);
        $abstractedObject = Song::constructFromArray($queryResults);
        return $abstractedObject;
    }

    /**
     * deleteSong
     *
     * @param  mixed $pdo
     * @param  mixed $song
     * @return int
     */
    public static function deleteSong($pdo, $song): int
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $song);
        return $queryResults;
    }

    /**
     * insertSong
     *
     * @param  mixed $pdo
     * @param  mixed $newSong
     * @return int
     */
    public static function insertSong($pdo, $newSong): int
    {
        $queryResults = DatabaseUtils::insertItem($pdo, $newSong);
        return $queryResults;
    }

    /**
     * updateSong
     *
     * @param  mixed $pdo
     * @param  mixed $song
     * @return int
     */
    public static function updateSong($pdo, $song): int
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $song);
        return $queryResults;
    }
}
