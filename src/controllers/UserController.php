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

    private static $regex = [
        "email" => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        "userName" => '/^[a-zA-Z0-9_]{3,16}$/',
        "password" => null,
        "activationCode" => '/^\d{6}$/'
    ];


    public static function getUserInfo(): void
    {
        Validator::isLogged();
        require __DIR__ . '/../views/profile.php';
    }


    public static function login(): void
    {
        if (!isset($_POST["userName"]) && !isset($_POST["email"])) {
            print '<h1>Inserte un Nombre o Email</h1>';
            require __DIR__ . '/../views/login.php';
            die(400);
        }

        $user = self::validateLoginName() ?? self::validateLoginEmail();
        self::validateLogin($user, $_POST["password"]);

        $_SESSION["isLogged"] = true;
        print '<h1> Sesion iniciada </h1>';
        print '<a href="/">Ir a inicio </a>';

    }


    public static function logOut(): void
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
        require __DIR__ . '/../views/index.php';
    }


    public static function register(): void
    {
        $fields = ['email', 'userName', 'password'];
        Validator::validateFields($fields, self::$regex, function () {
            require __DIR__ . '/../views/register.php';
            die(400);
        });

        try {
            $pdo = DbUtils::dbConnect();
            $user = UserModel::getUserByName($pdo, $_POST["userName"]) ?? UserModel::getUserByEmail($pdo, $_POST["email"]);

            $user = self::validateRegister($user);
            $result = UserModel::insertUser($pdo, $user);

            echo $result;
            echo 'Usuario creado con exito';
            require __DIR__ . '/../views/login.php';
            die(200);

        } catch (\PDOException $e) {
            print 'Error Interno';
            die(500);
        }

    }

    public static function validateActivation(): void
    {
        Validator::validateFields(['activationCode'], self::$regex, function () {
            print 'Debes enviar el codigo de activacion';
            require __DIR__ . '/../views/activate.php';
            exit(301);
        });

        if (!isset($_SESSION["code"])) {
            print '<h1>No has iniciado sesion para activar tu cuenta<h1>';
            require __DIR__ . '/../views/login.php';
            die(400);
        }

        if ($_SESSION["code"] . '' !== $_POST["activationCode"] . '') {
            echo 'codigo incorrecto';
            require __DIR__ . '/../views/login.php';
            die(400);
        }
        self::activateUser();
    }
    public static function editUser(): void
    {
        Validator::isLogged();
        $fields = self::validateEdit();
        $email = $fields[0];
        $userName = $fields[1];
        $is_active = isset($userName);

        try {
            $pdo = DbUtils::dbConnect();
            $result = UserModel::updateUser($pdo, new User($_SESSION["user"]->id_user, $userName, $email, null, $is_active));
            switch ($result) {
                case 1 :
                    print '<h1>El usuario se ha actualizado con exito</h1>';
                    $_SESSION["user"]->name = $userName ?? $_SESSION["user"]->name;
                    $_SESSION["user"]->email = $email ?? $_SESSION["user"]->email;
                    http_response_code(202);
                    break;
                case -1 :
                    print '<h1>El nombre/email ya existe pruebe otro</h1>';
                    http_response_code(400);
                    break;
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

    public static function getUserOrders()
    {
        Validator::isLogged();
        try {
            $pdo = DbUtils::dbConnect();
            $orders = UserModel::getUserOrders($pdo, $_SESSION["user"]->id_user);
            if (count($orders) === 0){
                print '<span> No tiene sningun pedido</span>';
            }
            foreach ($orders as $order){
                print '<div>';
                print_r($order);
                print '</div>';
            }
            exit(200);
        }catch (\PDOException $exception){
            print 'Internal server error';
            die(500);
        }
    }


    private static function validateEdit()
    {
        $fields = ["email", "userName"];

        $isValidEmail = Validator::validateFields(["email"], self::$regex);
        $isValidName = Validator::validateFields(["userName"], self::$regex);

        $userName = ($isValidName && $_POST["userName"] !== $_SESSION["user"]->name) ? $_POST["userName"] : null;
        $email = ($isValidEmail && $_POST["email"] !== $_SESSION["user"]->email) ? $_POST["email"] : null;
        $is_active = isset($email);

        if (!isset($userName) && !isset($email)) {
            require __DIR__ . '/../views/profile.php';
            exit(200);
        }
        return [$email, $userName, $is_active];
    }

    private static function sendCode(): void
    {
        $code = rand(100000, 999999);
        $_SESSION["code"] = $code;
        $user = $_SESSION["user"];
        Utils::sendMail($user->email, $user->name, 'admin@vost.com', 'VostAdmin', 'Account Activation Code', "$code");
    }

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
