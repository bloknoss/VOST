<?php

namespace VOST;

use VOST\models\Utils;
use PDO;
use PDOException;

class SongModel
{

    private $tableFields = ['id_song', 'artist', 'compositor', 'name', 'genre', 'duration'];
    public static function getSongs($pdo)
    {
        try {
            $query = "SELECT * FROM songs;";

            $result = $pdo->query($query);

            $resultSet = $result->fetch(PDO::FETCH_ASSOC);

            return $resultSet;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            echo ("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
    }

    public static function getSong($pdo, $songId)
    {
        try {
            $query = "SELECT * FROM songs WHERE id_song=:id_song";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':id_song', $songId);

            $stmt->execute();


            $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultSet;
        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
    }

    public static function deleteSong($pdo, $songId)
    {
        try {
            $query = "DELETE from songs where id_song=:id_song";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':id_song', $songId);

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

            $query = "INSERT INTO songs (id_song,artist,compositor,name,genre,duration) VALUES (:id_song,:artist,:compositor,:name,:genre,:duration)";

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


            $query = Utils::generateUpdateQuery($newSong, "songs", $tableFields);

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