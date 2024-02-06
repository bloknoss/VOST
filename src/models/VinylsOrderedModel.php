<?php

namespace VOST\models;

include_once __DIR__ . '/database/DatabaseUtils.php';
include_once __DIR__ . '/tables/VinylsOrdered.php';

use VOST\models\Database\DatabaseUtils;

class VinylsOrderedModel
{
    
    /**
     * deleteVinylOrdered
     *
     * @param  mixed $pdo
     * @param  mixed $vinylsOrdered
     * @return int
     */
    public static function deleteVinylOrdered($pdo, $vinylsOrdered) : int
    {
        $queryResults = DatabaseUtils::deleteItem($pdo, $vinylsOrdered);
        return $queryResults;
    }
    
    /**
     * insertVinylOrdered
     *
     * @param  mixed $pdo
     * @param  mixed $newVinylsOrdered
     * @return int
     */
    public static function insertVinylOrdered($pdo, $newVinylsOrdered) : int
    {
        $queryResults = DatabaseUtils::insertIntermediaryItem($pdo, $newVinylsOrdered);
        return $queryResults;
    }
    
    /**
     * updateVinylOrdered
     *
     * @param  mixed $pdo
     * @param  mixed $vinylsOrdered
     * @return int
     */
    public static function updateVinylOrdered($pdo, $vinylsOrdered) : int
    {
        $queryResults = DatabaseUtils::updateTable($pdo, $vinylsOrdered);
        return $queryResults;
    }
}
