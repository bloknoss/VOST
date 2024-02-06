<?php

namespace VOST\controllers;

class Validator
{
    public static function validateFields($fields, $regex, $handler)
    {
        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                print 'Debes incluir todos los campos';
                $handler();
            }
            if (strlen($_POST[$field]) > 255) {
                print 'Los atributos dados son demasiado largos';
                $handler();
            }
            if (!preg_match($regex[$field],$_POST[$field])){
                print $_POST[$field]. ' invalido';
                $handler();
            }
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