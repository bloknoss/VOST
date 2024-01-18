<?php

namespace VOST\models;

include_once 'vinyl.php';
include_once 'database.php';

use PDO;
use PDOException;
use VOST\models\Vinyl;
use VOST\models\Utils;
use VOST\models\Database;

class VinylModel
{

    public static function getVinylsOrdered($pdo, $vinyl)
    {
        $tableName = $vinyl->tableInfo['tableName'];
        $queryResults = Database::getItems($pdo, $tableName);
        return $queryResults;
    }

    public static function getVinylOrdered($pdo, $vinyl)
    {
        $queryResults = Database::getItem($pdo, $vinyl);
        return $queryResults;
    }

    public static function deleteVinylOrdered($pdo, $vinyl)
    {
        $queryResults = Database::deleteItem($pdo, $vinyl);
        return $queryResults;
    }

    public static function insertVinylOrdered($pdo, $newVinyl)
    {
        $queryResults = Database::insertItem($pdo, $newVinyl);
        return $queryResults;
    }

    public static function updateVinylOrdered($pdo, $vinyl)
    {
        $queryResults = Database::updateTable($pdo, $vinyl);
        return $queryResults;
    }

}

