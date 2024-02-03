<?php

use VOST\models\tables\CartVinyls;
use VOST\models\Utils;

include_once __DIR__ . '/Utils.php';
include_once __DIR__ . '/tables/CartVinyls.php';

class Tester
{
    public static function test()
    {
        try {
            $pdo = Utils::dbConnect();
            $testObject = (CartVinyls::constructIdObject(20));

            return $testObject;
        } catch (Exception $e) {
            echo $e;
        }
    }
}

echo '<pre>';
print_r(Tester::test());
echo '</pre>';
