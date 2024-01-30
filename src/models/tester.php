<?php

use VOST\models\User;
use VOST\models\UserModel;
use VOST\models\Utils;
use VOST\models\Vinyl;
use VOST\models\VinylModel;

include_once __DIR__ . 'Utils.php';
include_once 'VinylModel.php';

class Tester
{
    public static function test()
    {
        try{
            $pdo = Utils::dbConnect();
            
            $users = VinylModel::getHasSongs($pdo, 20);
            return $users;
        }catch(Exception $e){
            echo $e;
        }
    }
}

echo '<pre>';
print_r(Tester::test());
echo '</pre>';