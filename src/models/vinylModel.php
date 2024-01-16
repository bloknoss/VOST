<?php

namespace VOST;

use VOST\models\Utils;
use PDO;
use PDOException;

class VinylModel
{

    private $tableFields = ['id_vinyl', 'name', 'stock', 'price', 'style', 'duration', 'max_duration'];
    public static function getVinyls($pdo)
    {
        try {

            $query = "SELECT * FROM  vinyls;";

            $result = $pdo->query($query);

            $resultSet = $result->fetch(PDO::FETCH_ASSOC);

            return $resultSet;
        } catch (PDOException $e) {
            echo ("An error has occured while executing the SQL query in the database." . $e->getMessage());
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
    }

    public static function getVinyl($pdo, $vinylId)
    {
        try {
            $query = "SELECT * FROM  vinyls WHERE id_vinyl=:id_vinyl";


            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':id_vinyl', $vinylId);

            $stmt->execute();

            $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function deleteVinyl($pdo, $vinylId)
    {
        try {
            $query = "DELETE from vinyls where id_vinyl=:id_vinyl";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':id_vinyl', $vinylId);

            $stmt->execute();

            $affectedRows = $stmt->rowCount();

            return $affectedRows;

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            echo("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        } finally {
            $pdo = null;
        }
    }

    public static function insertVinyl($pdo, $newVinyl)
    {

        $tableFields = ['name','stock', 'price', 'style', 'duration', 'max_duration'];

        try {

            $query = "INSERT INTO vinyls (name,stock,price,style,duration,max_duration) VALUES (:name,:stock,:price,:style,:duration,:max_duration)";

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newVinyl, $tableFields);

            $stmt->execute();


        } catch (PDOException $e) {

            echo("An error has occured while executing the SQL query in the database." . $e->getMessage());
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return -1;
        } finally {
            $pdo = null;
        }
    }

    public static function updateVinyl($pdo,$newVinyl)
    {
        try {

            if (count($newVinyl) == 0)
                return -1;

            $tableFields = ['name', 'stock', 'price', 'style', 'duration', 'max_duration'];

            $query = Utils::generateUpdateQuery($newVinyl, "vinyls", $tableFields);
            echo $query;
            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newVinyl, $tableFields);

            $stmt->execute();

            $affectedRows = $stmt->rowCount();

            return $affectedRows;

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            echo("An error has occured while executing the SQL query in the database." . $e->getMessage());

            return -1;
        } finally {
            $pdo = null;
        }
    }

}