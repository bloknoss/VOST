<?php

namespace VOST\models\database;

use PDO;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;

class Utils
{


    public static function dbConnect(): PDO
    {
        $config = include(__DIR__ . "/../config.php");
        $config = $config["db"];

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

    public static function sendMail($target, $targetName, $sender, $senderName, $about, $message)
    {
        $config = require __DIR__ . '/../config.php';
        $config = $config["smtp"];

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = $config["hostname"];
            $mail->SMTPAuth = true;
            $mail->Username = $config["hostEmail"];
            $mail->Password = $config["password"];
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Detalles del correo
            $mail->setFrom($sender, $senderName);
            $mail->addAddress($target . "", $targetName);
            $mail->Subject = $about;

            $mail->Body = self::wrapEmail($message);


            // Enviar el correo
            $mail->send();
            print 'sended';
        } catch (\Exception $e) {
            print "Exception sending the mail";
        }
    }


    public static function generateInsertQuery($item)
    {
        $tableInfo = $item->tableInfo;
        $tableName = $tableInfo['tableName'];
        $tableFields = array_splice($tableInfo['tableFields'], 1);
        array_splice($tableFields, -1, 1);

        $baseQuery = "INSERT INTO $tableName (" . implode(',', $tableFields) . ") VALUES (:" . implode(',:', $tableFields) . ");";

        return $baseQuery;
    }

    public static function generateUpdateQuery($item)
    {

        $tableInfo = $item->tableInfo;
        $tableName = $tableInfo['tableName'];

        $tableFields = array_splice($tableInfo['tableFields'], 1);
        $tableValues = $tableInfo['tableValues'];
        $idField = $tableInfo['tableFields'][0];

        $baseQuery = "UPDATE $tableName SET ";

        $updateFields = [];

        foreach ($tableFields as $field) {
            if (isset($tableValues[$field]))
                $updateFields[] = "$field=:$field";
        }



        return ($baseQuery . implode(', ', $updateFields) . " WHERE $idField=:$idField");
    }

    public static function statementValueBinder($stmt, $item)
    {
        $tableInfo = $item->tableInfo;
        print_r($tableInfo);
        $tableValues = $tableInfo['tableValues'];
        $tableFields = $tableInfo['tableFields'];


        array_splice($tableValues, -1, 1);

        foreach ($tableFields as $field) {
            if (isset($tableValues[$field])) {
                var_dump($tableValues[$field]);
                if ($field == "is_active") {
                    
                } 
                $stmt->bindValue(":$field", $tableValues[$field] ?? 0);
            }
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

    public static function getValuesArray($object)
    {
        $tableValues = get_object_vars($object);
        return ($tableValues);
    }

    public static function getTableFields($table)
    {
        return array_keys($table);
    }

    private static function wrapEmail($message): string
    {
        $wrapper = '<h1> Codigo de activacion </h1> <br>';
        $wrapper .= "<div style='padding: 15px;border-radius: 15px;color: whitesmoke;background: darkgrey; width: 100px; display: flex; justify-content: center; align-content: center;' class='code'><span> $message </span> </div>";
        return $wrapper;
    }
}

