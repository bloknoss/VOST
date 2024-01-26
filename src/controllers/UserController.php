<?php

namespace VOST\controllers;

use PHPMailer\PHPMailer\PHPMailer;
use VOST\models\User;
use VOST\models\UserModel;
use VOST\models\Utils;

require __DIR__ . '/../models/User.php';
require __DIR__ . '/../models/UserModel.php';

class UserController
{

    private User $user;

    public static function login(): void
    {
        if (isset($_SESSION["name"])) {
            header('Location: http://localhost:80/user');
            return;
        }
        if (!isset($_POST["email"])) {
            require __DIR__ . '/../views/login.php';
            return;
        }
        $tableIdentifier = self::validateLogin($_POST["email"]);

        if ($tableIdentifier === -1) {
            require __DIR__ . '/../views/login.php';
            echo 'Inserte un email o username valido';
            return;
        }

        try {
            $pdo = Utils::dbConnect();
            $user = User::constructLoginObject($_POST["email"], $tableIdentifier);
            $user = UserModel::getUser($pdo, $user);

            if (is_null($user)) {
                require __DIR__ . '/../views/login.php';
                echo '<h1>User not found</h1>';
                return;
            }


            if (!password_verify($_POST["password"], $user->password)) {
                echo 'Acceso denegado';
                return;
            }
            
            if ($user->isActive) {
                $_SESSION["name"] = $user->name;
                $_SESSION["email"] = $user->email;
            }else
                echo "Debes activar tu cuenta";
        } catch (\Exception $e) {

        }

    }


    public static function get()
    {
        if (!isset($_SESSION["name"])){
            header('Location: http://localhost:80/login');
            return;
        }
        $userName = $_SESSION["name"];
        $email = $_SESSION["email"];
        echo '<h1> User </h1>';
        echo '<ul>';
        echo "<li>Email : $email</li>";
        echo "<li>Name : $userName</li>";
        echo '</ul>';
    }

    public static function logOut(): void
    {
        session_destroy();
        session_abort();
    }



    public static function createUser()
    {
        $postNames = ["name", "email", "password"];
        foreach ($postNames as $postName) {
            if (!isset($_POST[$postName])) {
                echo "Debes insertar tu $postName";
                return;
            }
        }

        if (!self::validateName($_POST["name"])) {
            echo 'El nombre de ususario no es valido';
            return;
        }
        if (!self::validateEmail($_POST["email"])) {
            echo 'El email no es valido';
            return;
        }
        try {

            $pdo = Utils::dbConnect();
            if (!is_null(UserModel::getUser($pdo, User::constructLoginObject($_POST["name"], 1)))) {
                echo "El usuario ya existe";
                return;
            }

            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $user = new User(null, $_POST["name"], $_POST["email"], $password);
            UserModel::insertUser($pdo, $user);
            echo 'Usuario creado con exito';

        } catch (\PDOException $e) {
            print 'Error al conectarse a la base de datos';
        }

        $user = new User(null, $_POST["name"], $_POST["email"], $_POST["password"]);

    }

    private static function validateLogin($email): int
    {
        if (self::validateEmail($email))
            return 0;
        if (self::validateName($email))
            return 1;

        return -1;
    }

    private static function validateEmail($email): bool
    {
        $regexEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($regexEmail, $email);
    }

    private static function validateName($email): bool
    {
        $regexUsername = '/^[a-zA-Z0-9_]{3,16}$/';
        return preg_match($regexUsername, $email);
    }
}
