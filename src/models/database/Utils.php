<?php

namespace VOST\models\database;

use PHPMailer\PHPMailer\PHPMailer;

class Utils
{

    /**
     * sendMail
     *
     * @param  mixed $target
     * @param  mixed $targetName
     * @param  mixed $sender
     * @param  mixed $senderName
     * @param  mixed $about
     * @param  mixed $message
     * @return void
     */
    public static function sendMail($target, $targetName, $sender, $senderName, $about, $message): void
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
            print 'sent';
        } catch (\Exception $e) {
            print "Exception sending the mail";
        }
    }


    /**
     * validateData
     *
     * @param  mixed $string
     * @return string
     */
    public static function validateData($string): string
    {
        $data = trim($string);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    /**
     * getValuesArray
     *
     * @param  mixed $object
     * @return array
     */
    public static function getValuesArray($object): array
    {
        $tableValues = get_object_vars($object);
        return ($tableValues);
    }

    /**
     * getTableFields
     *
     * @param  mixed $table
     * @return array
     */
    public static function getTableFields($table): array
    {
        return array_keys($table);
    }

    /**
     * wrapEmail
     *
     * @param  mixed $message
     * @return string
     */
    private static function wrapEmail($message): string
    {
        $wrapper = '<h1> Codigo de activacion </h1> <br>';
        $wrapper .= "<div style='padding: 15px;border-radius: 15px;color: whitesmoke;background: darkgrey; width: 100px; display: flex; justify-content: center; align-content: center;' class='code'><span> $message </span> </div>";
        return $wrapper;
    }
}
