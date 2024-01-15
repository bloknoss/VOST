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
            $query = "SELECT * FROM  VINYLS";

            $result = $pdo->query($query);

            $resultSet = $result->fetchAll();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function getVinyl($pdo, $vinylId)
    {
        try {
            $query = "SELECT * FROM  VINYLS WHERE vinyl_id=:vinyl_id";

            $result = $pdo->query($query);

            $stmt = $pdo->prepare($query);
            
            $stmt->bindValue(':vinyl_id', $vinylId);

            $resultSet = $result->fetchAll();

        } catch (PDOException $e) {
            error_log("An error has occured while executing the SQL query in the database." . $e->getMessage());
            die();
        }
        return $resultSet;
    }

    public static function deleteVinyl($pdo, $vinylId)
    {
        try {
            $query = "DELETE from VINYLS where vinyl_id=:vinyl_id";

            $stmt = $pdo->prepare($query);

            $stmt->bindValue(':vinyl_id', $vinylId);

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

            $query = "INSERT INTO VINYLS (id_vinyl,stock,price,style,duration,max_duration) VALUES (:id_vinyl,:stock,:price,:style,:duration,:max_duration)";

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

            $query = Utils::generateUpdateQuery($newVinyl, "VINYLS", $tableFields);

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