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

    public static function getHasSongs($pdo, $vinyl)
    {
        $tableName = $vinyl->tableInfo['tableName'];
        $queryResults = Database::getItems($pdo, $tableName);
        return $queryResults;
    }

    public static function getHasSong($pdo, $vinyl)
    {
        $queryResults = Database::getItem($pdo, $vinyl);
        return $queryResults;
    }

    public static function deleteHasSong($pdo, $vinyl)
    {
        $queryResults = Database::deleteItem($pdo, $vinyl);
        return $queryResults;
    }

    public static function insertHasSong($pdo, $newVinyl)
    {
        $queryResults = Database::insertItem($pdo, $newVinyl);
        return $queryResults;
    }

    public static function updateHasSong($pdo, $vinyl)
    {
        $queryResults = Database::updateTable($pdo, $vinyl);
        return $queryResults;
    }

}