<?php

namespace VOST\controllers;

class Validator
{
    public static array $statusCode = [-1 => 400, 0 => 204, 1 => 202];

    public static function validateFields($fields, $regex, $handler = null)
    {
        if (!isset($handler)) {
            $handler = fn() => false;
        }

        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                return $handler();
            }

            if (is_null($regex[$field])) continue;

            if (strlen($_POST[$field]) > 255) {
                print 'Los atributos dados son demasiado largos';
                return $handler();
            }


            if (!preg_match($regex[$field], $_POST[$field])) {
                print $field . ' invalido';
                return $handler();
            }
        }
        return true;
    }

    public static function isInactive()
    {
        if (isset($_SESSION['time'])) {

            //Tiempo de vida
            $inactive = 60 * 5;

            //Calculamos tiempo de vida inactivo.
            $session_life = time() - $_SESSION['time'];

            if ($session_life > $inactive) {
                UserController::logOut();
                exit();
            }
            // si no ha caducado la sesion, actualizamos
            $_SESSION['time'] = time();


        } else {
            $_SESSION['tiempo'] = time();
        }

    }

    public static function isLogged()
    {
        if (!isset($_SESSION["isLogged"])) {
            header('Location: http://localhost:80/user/login');
            exit(301);
        }
    }
}