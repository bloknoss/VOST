<?php

namespace VOST;

use VOST\model\Utils;
use PDOException;

class VinylModel
{

    private $tableFields = ['id_vinyl', 'stock','price','style','duration','max_duration'];
    public static function getVinyls($pdo)
    {
        try {

            $query = "SELECT * FROM  vinyls;";

            $result = $pdo->query($query);

            $resultSet = $result->fetchAll();

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

            $resultSet = $stmt->fetchAll();

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
            die();
        } finally {
            $pdo = null;
        }
    }

    public static function insertVinyl($pdo, $newVinyl)
    {

        $tableFields = ['id_vinyl', 'stock','price','style','duration','max_duration'];

        try {

            $query = "INSERT INTO vinyls (id_vinyl,stock,price,style,duration,max_duration) VALUES (:id_vinyl,:stock,:price,:style,:duration,:max_duration)";

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newVinyl, $tableFields);

            $stmt->execute();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            return -1;
        } finally {
            $pdo = null;
        }
    }

    public static function updateVinyl($pdo, $newVinyl)
    {
        try {

            if (count($newVinyl) == 0)
                return -1;

            $tableFields = ['id_vinyl', 'stock','price','style','duration','max_duration'];

            $query = Utils::generateUpdateQuery($newVinyl, "vinyls", $tableFields);

            $stmt = $pdo->prepare($query);

            $stmt = Utils::statementValueBinder($stmt, $newVinyl, $tableFields);

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