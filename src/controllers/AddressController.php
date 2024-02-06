<?php

namespace VOST\controllers;

use VOST\models\AddressModel;
use VOST\models\database\DatabaseUtils as DbUtils;
use VOST\models\tables\Address;

require __DIR__ . '/../models/AddressModel.php';

class AddressController
{
    private static array $regex = ['city' => null, 'postal_code' =>'/^\d{5}$/', 'street' => null, 'number' => null];
    private static array $statusCode = [-1 => 400, 0 => 204, 1 => 202];

    public static function getAdresses(): never
    {
        Validator::isLogged();
        try {
            $pdo = DbUtils::dbConnect();
            $addresses = AddressModel::getUserAddresses($pdo, $_SESSION["user"]->id_user);
            require __DIR__ . '/../views/adress.php';
            exit(200);
        } catch (\PDOException $exception) {
            die(500);
        }
    }


    public static function deleteAddress($id_address): never
    {
        Validator::isLogged();
        try {
            $pdo = DbUtils::dbConnect();
            $result = AddressModel::deleteAddress($pdo, new Address($id_address, $_SESSION['user']->id_user, null, null, null, null));
            print $result;
            exit(Validator::$statusCode[$result]);
        } catch (\PDOException $exception) {
            die(500);
        }
    }

    public static function addAddress():never
    {
        Validator::isLogged();

        Validator::validateFields(array_keys(self::$regex), self::$regex, function () {
            print 'Campo invalido';
            exit(400);
        });

        try {
            $pdo = DbUtils::dbConnect();
            $result = AddressModel::insertAddress($pdo, new Address(null, $_SESSION["user"]->id_user, $_POST["postal_code"], $_POST["city"], $_POST["street"], $_POST["number"]));
            exit(Validator::$statusCode[$result]);
        } catch (\PDOException $exception) {
            die(500);
        }
    }




}