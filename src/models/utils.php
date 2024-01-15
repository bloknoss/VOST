<?php

namespace VOST\model;

use PDO;
use PDOException;

class Utils
{

    public static function dbConnect()
    {
        $config = include("../config.php");

        // Sacamos las variables del archivo de configuración fuera para evitar añadir demasiado código más adelante
        $dbname = $config["dbname"];
        $hostname = $config["hostname"];

        // Establecemos una conexión con el PDO haciendo uso de las variables de conexión.
        try {
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $config["username"], $config["password"]);
        } catch (PDOException $e) {
            error_log("An error has occured while establishing a connection with the database." . $e->getMessage());
        }

        return $pdo;
    }

    public static function generateUpdateQuery($newItem, $tableName, $tableFields)
    {
        $baseQuery = "UPDATE $tableName set ";
        $updateFields = [];

        foreach ($tableFields as $field) {
            if (isset($newItem[$field]))
                $updateFields[] = "$field=:$field";
        }

        return $baseQuery . implode(', ', $updateFields);
    }

    public static function statementValueBinder($stmt, $item, $tableFields)
    {
        foreach ($tableFields as $field) {
            if (isset($item[$field]))
                $stmt->bindValue(":$field", $item[$field]);
        }
        return $stmt;
    }


    public static function validateData($string)
    {
        $data = trim($string);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }


}
