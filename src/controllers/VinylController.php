<?php

namespace VOST\controllers;

use VOST\models\database\DatabaseUtils as Utils;
use VOST\models\VinylModel;
use VOST\models\tables\Vinyl;

require __DIR__.'/../models/tables/Vinyl.php';
require __DIR__ . '/../models/VinylModel.php';

class VinylController
{

    public static function getVinyls():array
    {
        if (!isset($_SESSION["isLogged"])){
            require __DIR__.'/../views/login.php';
            exit(300);
        }
        try {
            $pdo = Utils::dbConnect();
            $vinyls = VinylModel::getVinyls($pdo);
            require __DIR__.'/../views/shop.php';
            die(200);
        }catch (\PDOException $exception){
            die(500);
        }
    }
    public static function getVinyl($id)
    {
        if (!isset($_SESSION["isLogged"])){
            require __DIR__.'/../views/login.php';
            exit(300);
        }
        try {
            $pdo = Utils::dbConnect();
            $vinyl = VinylModel::getVinyl($pdo, Vinyl::constructIdObject(intval($id)));
            if (is_null($vinyl)){
                print 'not found';
                die(200);
            }
            $songs = VinylModel::getSongs($pdo, $vinyl->id_vinyl);
            require __DIR__.'/../views/vinyl.php';
            die(200);
        }catch (\PDOException $exception){
            die(500);
        }
    }
}