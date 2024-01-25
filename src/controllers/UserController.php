<?php
namespace VOST\controllers;

use PHPMailer\PHPMailer\PHPMailer;
use VOST\models\User;
use VOST\models\UserModel;
use VOST\models\Utils;

require __DIR__.'/../models/user.php';
require __DIR__.'/../models/userModel.php';
class UserController {

    private User $user;

    public static function login():void
    {
        if (!isset($_POST["userName"]) && !isset($_POST["email"])){
            require __DIR__.'/../views/login.php';
            return;
        }

        $_SESSION["userName"] = $_POST["userName"];
    }
    public static function getUser():void
    {
        if (isset($_SESSION["userName"]))
            try {
                $pdo = Utils::dbConnect();
                $user = UserModel::getUser($pdo, User::constructIdObject(2005));
                print "<h1>$user->name </h1>";
                print "<ul>";
                print "<li>$user->id_user</li>";
                print "<li>$user->email</li>";
                print "</ul>";
            }catch(\PDOException $e){
                echo "There has been an error with the db";
                die(500);
            }

        else
            header('Location: http://localhost:80/login');
    }
    public static function logOut():void
    {
        session_destroy();
        session_abort();
    }
    public static function sendMail()
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ramontxuwar03@gmail.com';
            $mail->Password = 'O9X2aqw70m5scZnP';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Detalles del correo
            $mail->setFrom('admin@vost.com', 'Tu Nombre');
            $mail->addAddress('jgalazc253@g.educaand.es', 'Nombre Destinatario');
            $mail->Subject = 'Asunto del correo';
            $mail->Body = 'Contenido del correo';

            // Enviar el correo
            $mail->send();
            print 'sended';
        }catch (\Exception $e){
            print "Exception sending the mail";
        }
    }

}