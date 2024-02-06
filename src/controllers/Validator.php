<?php

namespace VOST\controllers;

class Validator
{
    public static function validateFields($fields, $regex, $handler = null)
    {
        if (!isset($handler)) {
            $handler = fn() => false;
        }
        
        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                return $handler();
            }
            if (strlen($_POST[$field]) > 255) {
                print 'Los atributos dados son demasiado largos';
                return $handler();
            }
            
            if (is_null($regex[$field])) continue;

            if (!preg_match($regex[$field],$_POST[$field])){
                print $_POST[$field]. ' invalido';
                return $handler();
            }
        }
        return true;
    }

    public static function isLogged()
    {
        if (!isset($_SESSION["isLogged"])) {
            header('Location: http://localhost:80/user/login');
            exit(301);
        }
    }
}