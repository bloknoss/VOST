<?php

namespace VOST\models;

include_once __DIR__ . '/tables/Vinyl.php';
include_once __DIR__ . '/database/DatabaseUtils.php';

use VOST\models\tables\HasSongs;
use VOST\models\database\DatabaseUtils;

class HasSongsModel
{

    
    /**
     * deleteHasSong
     *
     * @param  mixed $pdo
     * @param  mixed $hasSongs
     * @return int
     */
    public static function deleteHasSong($pdo, $hasSongs) : int
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $hasSongs);
        return $queryResults;
    }
    
    /**
     * insertHasSong
     *
     * @param  mixed $pdo
     * @param  mixed $newHasSongs
     * @return int
     */
    public static function insertHasSong($pdo, $newHasSongs) : int
    {
        $queryResults = DatabaseUtils::insertIntermediaryItem($pdo, $newHasSongs);
        return $queryResults;
    }
    
    /**
     * updateHasSong
     *
     * @param  mixed $pdo
     * @param  mixed $hasSongs
     * @return int
     */
    public static function updateHasSong($pdo, $hasSongs) : int
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $hasSongs);
        return $queryResults;
    }
}
