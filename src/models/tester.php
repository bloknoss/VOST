<?php

use VOST\models\User;
use VOST\models\UserModel;
use VOST\models\Utils;

include_once __DIR__ . 'Utils.php';

class Tester
{
    public static function test()
    {
        try{
            $pdo = Utils::dbConnect();
            
            $users = UserModel::getUserByName($pdo, "Randi");
            return $users;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

echo '<pre>';
print_r(Tester::test());
echo '</pre>';