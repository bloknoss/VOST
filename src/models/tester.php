<?php

use VOST\models\User;
use VOST\models\UserModel;
use VOST\models\Utils;

include_once __DIR__ . '/Utils.php';
include_once 'VinylModel.php';

class Tester
{
    public static function test()
    {
        try {
            $pdo = Utils::dbConnect();
            UserModel::updateUser($pdo, new User(2002,"vaginesil", "viagraenlatadaconatun@marihuana.weed","niggatopia","0"));
        } catch (Exception $e) {
            echo $e;
        }
    }
}

echo '<pre>';
print_r(Tester::test());
echo '</pre>';