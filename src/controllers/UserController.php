<?php

namespace VOST\controllers;

use VOST\models\database\DatabaseUtils as DbUtils;
use VOST\models\tables\User;
use VOST\models\UserModel;
use VOST\models\Utils as utils;

require __DIR__ . '/../models/tables/User.php';
require __DIR__ . '/../models/UserModel.php';

class UserController
{

    //Regular expresions que se usaran para validar diferentes inputs de para el user
    private static $regex = [
        "email" => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        "userName" => '/^[a-zA-Z0-9_]{3,16}$/',
        "password" => null,
        "activationCode" => '/^\d{6}$/'
    ];



    //Obtener informacion del ususario (abrir el prefil)
    public static function getUserInfo(): void
    {
        Validator::isLogged();
        require __DIR__ . '/../views/profile.php';
    }


    //Funcion de login

    public static function login(): void
    {
        //Si no hay ningun identificador redirecciona a login
        if (!isset($_POST["userName"]) && !isset($_POST["email"])) {
            print '<h1>Inserte un Nombre o Email</h1>';
            require __DIR__ . '/../views/login.php';
            die(400);
        }

        //valida el email o name (depende de lo que se inserte)
        $user = self::validateLoginName() ?? self::validateLoginEmail();
        //validadiones
        self::validateLogin($user, $_POST["password"]);

        //si pasa las validaciones establezco el login
        $_SESSION["isLogged"] = true;
        require __DIR__.'/../views/profile.php';
    }


    //logout
    public static function logOut(): void
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
        require __DIR__ . '/../views/index.php';
    }


    //funcion de registro
    public static function register(): void
    {
        //Validacion de los campos
        $fields = ['email', 'userName', 'password'];
        Validator::validateFields($fields, self::$regex, function () {
            require __DIR__ . '/../views/register.php';
            die(400);
        });

        try {
            $pdo = DbUtils::dbConnect();
            $user = UserModel::getUserByName($pdo, $_POST["userName"]) ?? UserModel::getUserByEmail($pdo, $_POST["email"]);

            //si pasa las validaciones se crea el user
            $user = self::validateRegister($user);
            $result = UserModel::insertUser($pdo, $user);

            echo 'Usuario creado con exito';
            require __DIR__ . '/../views/login.php';
            die(200);

        } catch (\PDOException $e) {
            print 'Error Interno';
            die(500);
        }

    }

    //Funcion que recibe el codigo de activacion
    public static function validateActivation(): void
    {
        //valido el codigo
        Validator::validateFields(['activationCode'], self::$regex, function () {
            print 'Debes enviar el codigo de activacion';
            require __DIR__ . '/../views/activate.php';
            exit(301);
        });

        //si la ssesion no tiene code es que o no se ha enviado el email desde esta sesion o se esta iniciando sesion
        if (!isset($_SESSION["code"])) {
            print '<h1>No has iniciado sesion para activar tu cuenta<h1>';
            require __DIR__ . '/../views/login.php';
            die(400);
        }

        //si no coincide el codigo
        if ($_SESSION["code"] . '' !== $_POST["activationCode"] . '') {
            echo 'codigo incorrecto';
            require __DIR__ . '/../views/login.php';
            die(400);
        }
        //Si el codigo es valido
        self::activateUser();
    }

    //Funcion para editar el user
    public static function editUser(): void
    {
        Validator::isLogged();
        //Validacion de campos y asignacion de variables
        $fields = self::validateEdit();
        $email = $fields[0];
        $userName = $fields[1];
        $is_active = isset($userName);


        try {
            $pdo = DbUtils::dbConnect();
            $result = UserModel::updateUser($pdo, new User($_SESSION["user"]->id_user, $userName, $email, null, $is_active));
            switch ($result) {
                //si todo es exitoso
                case 1 :
                    print '<h1>El usuario se ha actualizado con exito</h1>';
                    $_SESSION["user"]->name = $userName ?? $_SESSION["user"]->name;
                    $_SESSION["user"]->email = $email ?? $_SESSION["user"]->email;
                    http_response_code(202);
                    break;
                //Si ha habido un fallo
                case -1 :
                    print '<h1>El nombre/email ya existe pruebe otro</h1>';
                    http_response_code(400);
                    break;
                //Si no se ha actualizado nada (osea ha habido un fallo)
                default:
                    print 'Error inesperado';
                    http_response_code(500);
            };
            require __DIR__ . '/../views/profile.php';
            exit();

        } catch (\PDOException $exception) {
            print '<h1>Error interno</h1>';
            die(500);
        }
    }

    //funcion que activa el usuario y lo logea
    private static function activateUser(): never
    {
        try {
            $user = $_SESSION["user"];
            $pdo = DbUtils::dbConnect();

            UserModel::updateUser($pdo, new User($user->id_user, null, null, null, true));
            $_SESSION["isLogged"] = true;

            echo 'Usuario activado';
            require __DIR__ . '/../views/profile.php';
            exit(200);
        } catch (\PDOException $e) {
            die(500);
        }
    }


    //Validacin de los inputs para el edit del user
    private static function validateEdit()
    {
        $fields = ["email", "userName"];

        $isValidEmail = Validator::validateFields(["email"], self::$regex);
        $isValidName = Validator::validateFields(["userName"], self::$regex);

        //Si no hay input o es igual al que ya hay el campo valdra null para que no se actualice
        $userName = ($isValidName && $_POST["userName"] !== $_SESSION["user"]->name) ? $_POST["userName"] : null;
        $email = ($isValidEmail && $_POST["email"] !== $_SESSION["user"]->email) ? $_POST["email"] : null;
        $is_active = isset($email);

        //si no se actualiza ninguno termino el programa
        if (!isset($userName) && !isset($email)) {
            require __DIR__ . '/../views/profile.php';
            exit(200);
        }
        //devuelvo los campos
        return [$email, $userName, $is_active];
    }

    //Funcion para enviar el cod de activacion
    private static function sendCode(): void
    {
        $code = rand(100000, 999999);
        $_SESSION["code"] = $code;
        $user = $_SESSION["user"];
        Utils::sendMail($user->email, $user->name, 'admin@vost.com', 'VostAdmin', 'Account Activation Code', "$code");
    }

    //validacion del login desde el result de la bdd a
    private static function validateLogin($user, $password): void
    {
        if (!isset($user)) {
            require __DIR__ . '/../views/login.php';
            print 'Email o nombre invalido';
            exit(400);
        }
        if ($user === 'not_found') {
            require __DIR__ . '/../views/login.php';
            echo '<h1>User not found</h1>';
            die(400);
        }

        if (!password_verify($password, $user->password)) {
            require __DIR__ . '/../views/login.php';
            echo '<h1>Contraseña incorrecta</h1>';
            die(400);
        }

        $_SESSION["user"] = $user;

        if (!$user->is_active) {
            self::sendCode();
            require __DIR__ . '/../views/activate.php';
            exit(300);
        }
    }


    private static function validateLoginName(): ?User
    {
        if (!Validator::validateFields(["userName", "password"], self::$regex)) {
            return null;
        }
        try {
            $pdo = DbUtils::dbConnect();
            return UserModel::getUserByName($pdo, $_POST["userName"]) ?? 'not_found';
        } catch (\PDOException $exception) {
            print 'Error interno del servidor';
            die(500);
        }
    }

    private static function validateLoginEmail(): ?User
    {
        if (!Validator::validateFields(["email", "password"], self::$regex)) {
            return null;
        }
        try {
            $pdo = DbUtils::dbConnect();
            $user = UserModel::getUserByEmail($pdo, $_POST["email"]) ?? 'not_found';
            return $user;
        } catch (\PDOException $exception) {
            print 'Error interno del servidor';
            die(500);
        }

    }

    private static function validateRegister($user): User
    {
        if (isset($user)) {
            echo "El usuario ya existe";
            require __DIR__ . '/../views/register.php';
            exit(400);
        }

        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        return new User(null, $_POST["userName"], $_POST["email"], $password);
    }

}
