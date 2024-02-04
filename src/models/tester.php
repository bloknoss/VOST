<?php

namespace VOST\models;

use VOST\models\AddressModel;
use VOST\models\CartModel;
use VOST\models\tables\CartVinyls;
use VOST\models\CartVinylsModel;
use VOST\models\database\DatabaseUtils;
use VOST\models\database\QueryUtils;
use VOST\models\OrderModel;
use VOST\models\tables\Address;
use VOST\models\tables\User;
use VOST\models\UserModel;

include_once __DIR__ . '/database/DatabaseUtils.php';
include_once __DIR__ . '/database/QueryUtils.php';
include_once __DIR__ . '/tables/CartVinyls.php';
include_once __DIR__ . '/AddressModel.php';
include_once __DIR__ . '/CartModel.php';
include_once __DIR__ . '/OrderModel.php';

class Tester
{
    public static function test()
    {
        try {

            $pdo = DatabaseUtils::dbConnect();
            $testObject = OrderModel::getOrderedVinyls($pdo,31);

            return $testObject;
        } catch (Exception $e) {
            echo $e;
        }
    }
}

echo '<pre>';
print_r(Tester::test());
echo '</pre>';
