<?php

namespace VOST\controllers;

use VOST\models\Utils;
use VOST\models\VinylModel;
use VOST\models\Vinyl;

require __DIR__.'/../models/Vinyl.php';
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
            $songs = VinylModel::getSongs($pdo, $vinyl->id_vinyl);
            print_r($songs);
            require __DIR__.'/../views/vinyl.php';
            die(200);
        }catch (\PDOException $exception){
            die(500);
        }
    }
}