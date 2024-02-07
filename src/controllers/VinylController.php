<?php

namespace VOST\controllers;

use VOST\models\database\DatabaseUtils as Utils;
use VOST\models\VinylModel;
use VOST\models\tables\Vinyl;
use VOST\controllers\Validator;

require __DIR__.'/../models/tables/Vinyl.php';
require __DIR__ . '/../models/VinylModel.php';

class VinylController
{

    public static function getVinyls():array
    {
        Validator::isLogged();
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
        Validator::isLogged();

        try {
            $pdo = Utils::dbConnect();
            $vinyls = VinylModel::getVinyl($pdo, Vinyl::constructIdObject(intval($id)));
            if (is_null($vinyls)){
                print 'not found';
                die(200);
            }
            $songs = VinylModel::getSongs($pdo, $vinyls->id_vinyl);
            require __DIR__.'/../views/vinyl.php';
            die(200);
        }catch (\PDOException $exception){
            die(500);
        }
    }

    public static function getSongs($id)
    {
        Validator::isLogged();
        try {
            $pdo = Utils::dbConnect();
            $songs = VinylModel::getSongs($pdo, $id);
            require __DIR__.'/../views/song.php';
            die(203);
        }catch (\PDOException $e){
            die(500);
        }

    }

}