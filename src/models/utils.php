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

    public static function validateData($string)
    {
        $data = trim($string);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }


}

?>