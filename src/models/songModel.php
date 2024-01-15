<?php

namespace VOST;

use VOST\model\Utils;
use PDOException;

class SongModel
{

    private $tableFields = ['id_song', 'artist', 'compositor', 'name', 'genre', 'duration'];
    public static function getSongs($pdo)
    {
        try {
            $query = "SELECT * FROM  SONGS";

            $result = $pdo->query($query);

            $resultSet = $result->fetchAll();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function getSong($pdo, $songId)
    {
        try {
            $query = "SELECT * FROM  SONGS WHERE song_id=:song_id";

            $result = $pdo->query($query);

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':song_id', $songId);

            $resultSet = $result->fetchAll();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function deleteSong($pdo, $songId)
    {
        try {
            $query = "DELETE from SONGS where song_id=:song_id";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':song_id', $songId);

            $stmt->execute();

            $affectedRows = $stmt->rowCount();

            return $affectedRows;

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        } finally {
            $pdo = null;
        }
    }

    public static function insertSong($pdo, $newSong)
    {
        $tableFields = ['id_song', 'artist', 'compositor', 'name', 'genre', 'duration'];

        try {

            $query = "INSERT INTO SONGS (id_song,artist,compositor,name,genre,duration) VALUES (:id_song,:artist,:compositor,:name,:genre,:duration)";

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newSong, $tableFields);

            $stmt->execute();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return -1;
        } finally {
            $pdo = null;
        }
    }

    public static function updateSong($pdo, $newSong)
    {
        try {

            if (count($newSong) == 0)
                return -1;
            $tableFields = ['id_song', 'artist', 'compositor', 'name', 'genre', 'duration'];


            $query = Utils::generateUpdateQuery($newSong, "SONGS", $tableFields);

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newSong, $tableFields);

            $stmt->execute();

            $affectedRows = $stmt->rowCount();

            return $affectedRows;

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return -1;
        } finally {
            $pdo = null;
        }
    }

}