<?php

namespace VOST\controllers;

use JetBrains\PhpStorm\NoReturn;
use VOST\models\database\UserModel;
use VOST\models\database\Utils;
use VOST\models\User;

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


            if (!$user->isActive){
                $_SESSION["user"] = $user;
                self::sendCode();
            }

            $_SESSION["isLogged"] = true;
            print '<h1> Sesion iniciada </h1>';
            print '<a href="/">Ir a inicio </a>';
        } catch (\Exception $e) {
            die(500);
        }

    }


    public static function get():void
    {
        if (!isset($_SESSION["isLogged"])) {
            exit(404);
        }

        $user = $_SESSION["user"];
        $userName = $user->name;
        $email = $user->email;
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
            require __DIR__.'/../views/login.php';

        } catch (\PDOException $e) {
            print 'Error al conectarse a la base de datos';
        }

    }

    public static function checkCode()
    {
        if (!isset($_POST["activationCode"])) {
            echo 'Inserta el codigo';
            return ;
        }
        if (!isset($_SESSION["code"])) {
            return;
        }
        if ($_SESSION["code"].'' === $_POST["activationCode"].''){
            $user = $_SESSION["user"];
            $user->isActive = true;
            $pdo = Utils::dbConnect();
            UserModel::activateUser($pdo,$user);
            $_SESSION["isLogged"] = true;
            echo 'Usuario activado';
            exit(200);
        }
        echo 'codigo incorrecto';
        exit(400);
    }

    private static function sendCode():void
    {
        $code = rand(100000, 999999);
        $_SESSION["code"] = $code;
        $user = $_SESSION["user"];
        Utils::sendMail($user->email, $user->name, 'admin@vost.com', 'VostAdmin', 'Account Activation Code', "$code");
        require __DIR__ . '/../views/activate.php';
        exit(300);
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
