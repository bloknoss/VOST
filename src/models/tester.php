<?php

use VOST\models\User;
use VOST\models\database\UserModel;
use VOST\models\database\Utils;

include_once __DIR__ . 'database/Utils.php';

class Tester
{
    public static function test()
    {
        try{

            $pdo = Utils::dbConnect();
            $user = UserModel::getUsers($pdo, User::constructIdObject(0));
            return $user;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

echo '<pre>';
print_r(Tester::test());
echo '</pre>';