<?php

namespace VOST\controllers;

use VOST\models\User;
use VOST\models\UserModel;
use VOST\models\Utils;
use VOST\models\Cart;
use VOST\models\CartModel;

require __DIR__ . '/../models/User.php';
require __DIR__ . '/../models/UserModel.php';

class UserController
{

    private User $user;

    public static function getUserInfo(): void
    {
        if (!isset($_SESSION["isLogged"])) {
            require __DIR__ . '/../views/login.php';
            exit(400);
        }
        require __DIR__ . '/../views/profile.php';

    }


    public static function login(): void
    {
        //Comprobacion de que no este logueado y que se hayan enviado un name o username
        if (isset($_SESSION["isLogged"])) {
            header('Location: http://localhost:80/user');
            return;
        }

        if (!isset($_POST["userName"]) && !isset($_POST["email"])) {
            require __DIR__ . '/../views/login.php';
            print '<h1>Inserte un Nombre o Email</h1>';
            return;
        }

        //Obtener el nombre
        $user = '';
        if (isset($_POST["email"])) {
            $email = Utils::validateData($_POST["email"]);
            $user = self::validateLoginEmail($email);
        }
        if (isset($_POST["userName"])) {
            $name = Utils::validateData($_POST["userName"]);
            $user = self::validateLoginName($name);
        }

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
        if (!isset($_POST["userName"]) || !isset($_POST["email"]) || !isset($_POST["password"])) {
            echo "<h1>Debes introducir todos los campos</h1>";
            require __DIR__ . '/../views/register.php';
            die(400);
        }
        self::validateRegister();

        try {
            $pdo = Utils::dbConnect();
            $user = UserModel::getUserByName($pdo, $_POST["userName"]);

            $user = (is_null($user)) ? UserModel::getUserByEmail($pdo, $_POST["email"]) : $user;
            if (!is_null($user)) {
                echo "El usuario ya existe";
                exit(400);
            }

            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $user = new User(null, $_POST["userName"], $_POST["email"], $password);
            UserModel::insertUser($pdo, $user);

            echo 'Usuario creado con exito';
            require __DIR__ . '/../views/login.php';
            die(200);

        } catch (\PDOException $e) {
            print 'Error Interno';
            die(500);
        }

    }

    private static function validateRegister(): void
    {
        if (!self::validateName($_POST["userName"])) {
            echo "<h1>El nombre se usuario no es valido</h1>";
            require __DIR__ . '/../views/register.php';
            die(400);
        }
        if (!self::validateEmail($_POST["email"])) {
            echo "<h1>El email no es valido</h1>";
            require __DIR__ . '/../views/register.php';
            die(400);
        }

    }

    public static function validateActivation(): void
    {
        if (!isset($_POST["activationCode"])) {
            echo 'Inserta el codigo';
            require __DIR__ . '/../views/login.php';
            die(400);
        }

        if (!isset($_SESSION["code"])) {
            print '<h1>No se ha enviado ningun correo<h1>';
            require __DIR__ . '/../views/login.php';
            die(400);
        }

        if ($_SESSION["code"] . '' === $_POST["activationCode"] . '') {
            $user = $_SESSION["user"];
            $pdo = Utils::dbConnect();
            UserModel::updateUser($pdo, new User($user->id_user, null, null, null, true));
            $_SESSION["isLogged"] = true;
            echo 'Usuario activado';
            require __DIR__ . '/../views/profile.php';
            exit(200);
        }

        echo 'codigo incorrecto';
        require __DIR__ . '/../views/login.php';
        die(400);
    }

    public static function getUserOrders()
    {
        if (!isset($_SESSION["isLogged"])){
            require __DIR__.'/../views/login.php';
            exit(300);
        }
        try {
            $pdo = Utils::dbConnect();
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
    public static function editUser(): void
    {
        if (!isset($_SESSION["isLogged"])) {
            print '<h1> Debes inicar sesion </h1>';
            require __DIR__ . '/../views/login.php';
            die(300);
        }

        $userName = $_POST["userName"];
        $email = $_POST["email"];
        $is_active = false;

        if (!isset($userName) || !self::validateName($userName) || $_SESSION["user"]->name === $userName)
            $userName = null;


        if (!isset($email) || !self::validateEmail($email) || $_SESSION["user"]->email === $email) {
            $email = null;
            $is_active = null;
        }

        if (is_null($email) && is_null($userName)){
            header('Location: http://localhost:80/user');
            exit(200);
        }
        try {
            $pdo = Utils::dbConnect();
            $result = UserModel::updateUser($pdo, new User($_SESSION["user"]->id_user, $userName, $email, null, $is_active));
            $_SESSION["user"]->name = (is_null($userName)) ? $_SESSION["user"]->name : $userName;
            $_SESSION["user"]->email = (is_null($email)) ? $_SESSION["user"]->email : $email;
            if ($result) {
                print '<h1>El usuario se ha actualizado con exito</h1>';
                header('Location: http://localhost:80/user');
                exit(200);
            }

        } catch (\PDOException $exception) {
            print '<h1>Error interno</h1>';
            die(500);
        }
    }

    public static function addToCart()
    {
        if (!isset($_SESSION["isLogged"])){
            header('Location: http://localhost:80/user/login');
            exit(300);
        }
        if (!isset($_POST["id_vinyl"])){
            header('Location: http://localhost:80/shop');
            exit(300);
        }
        require __DIR__.'/../models/CartModel.php';
        $id_vinyl = $_POST["id_vinyl"];
        try {
            $pdo = Utils::dbConnect();
            CartModel::addVinylToCart($pdo, );

        }catch (\PDOException $e) {
            die(500);
        }

        exit(200);
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
        if (is_null($user)) {
            require __DIR__ . '/../views/login.php';
            echo '<h1>User not found</h1>';
            die(400);
        }

        if (!password_verify($password, $user->password)) {
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


    private static function validateLoginName($name)
    {
        if (!self::validateName($name)) {
            require __DIR__ . '/../views/login.php';
            echo 'Inserte un nombre valido';
            exit(400);
        }
        try {
            $pdo = Utils::dbConnect();
            return UserModel::getUserByName($pdo, $name);
        } catch (\PDOException $exception) {
            print 'Error interno del servidor';
            die(500);
        }
    }

    private static function validateLoginEmail($email)
    {
        if (!self::validateEmail($email)) {
            require __DIR__ . '/../views/login.php';
            echo 'Inserte un email valido';
            exit(400);
        }
        try {
            $pdo = Utils::dbConnect();
            return UserModel::getUserByEmail($pdo, $email);
        } catch (\PDOException $exception) {
            print 'Error interno del servidor';
            die(500);
        }

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
