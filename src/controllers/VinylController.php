<?php

namespace VOST\controllers;

use VOST\models\Utils;
use VOST\models\VinylModel;

require __DIR__ . '/../models/Vinyl.php';
require __DIR__ . '/../models/VinylModel.php';

class VinylController
{

    public static function getVinyls()
    {
        if (!isset($_SESSION["isLogged"])){
            require __DIR__.'/../views/login.php';
            exit(300);
        }
        try {
            $pdo = Utils::dbConnect();
            $vinyls = VinylModel::getVinyls($pdo);
            require __DIR__.'/../views/shop.php';
        }catch (\PDOException $exception){
            die(500);
        }
    }
}