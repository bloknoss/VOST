<?php

use VOST\models\tables\CartVinyls;
use VOST\models\database\DatabaseUtils;

include_once __DIR__ . '/database/DatabaseUtils.php';
include_once __DIR__ . '/tables/CartVinyls.php';

class Tester
{
    public static function test()
    {
        try {
            $pdo = DatabaseUtils::dbConnect();
            $testObject = DatabaseUtils::getItem($pdo,CartVinyls::constructIdObject(20));

            return $testObject;
        } catch (Exception $e) {
            echo $e;
        }
    }
}

echo '<pre>';
print_r(Tester::test());
echo '</pre>';
