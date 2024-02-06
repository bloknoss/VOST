<?php

namespace VOST\controllers;

use VOST\models\AddressModel;
use VOST\models\database\DatabaseUtils as DbUtils;
use VOST\models\tables\Address;

require __DIR__ . '/../models/AddressModel.php';

class AddressController
{
    public static function getAdresses()
    {
        Validator::isLogged();
        try {
            $pdo = DbUtils::dbConnect();
            $addresses = AddressModel::getUserAddresses($pdo, $_SESSION["user"]->id_user);
            require __DIR__.'/../views/adress.php';
            exit(200);
        } catch (\PDOException $exception) {
            die(500);
        }
    }

    public static function deleteAddress($id_address): never
    {
        Validator::isLogged();

    }

    public static function addAddress()
    {
        Validator::isLogged();

        self::validateFields();

        try {
            $pdo = DbUtils::dbConnect();
            $result = AddressModel::insertAddress($pdo, new Address(null, $_SESSION["user"]->id_user, $_POST["postal_code"], $_POST["city"], $_POST["street"], $_POST["number"]));
            switch ($result) {
                case 1 :
                    exit(201);
                case 0:
                    exit(204);
                case -1:
                    die(500);
            }
        } catch (\PDOException $exception) {
            die(500);
        }
    }

    private static function validateFields()
    {
        $fields = ['city', 'postal_code', 'city', 'street', 'number'];
        $regex = ['/^.{1,255}$/', '/^\d{5}$/', '/^.{1,255}$/', '/^.{1,255}$/', '/^.{1,255}$/'];
        $regex = array_combine($fields, $regex);

        Validator::validateFields($fields, $regex, function () {
            exit(400);
        });
        if (!preg_match('/^\d{5}$/', $_POST[$fields[1]])) {
            print 'Introduzca un codigo postal valido';
            exit(400);
        }

    }


}