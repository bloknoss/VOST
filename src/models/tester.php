<?php

namespace VOST\model;

include_once 'utils.php';
include_once 'userModel.php';
include_once 'vinylModel.php';
include_once 'songModel.php';
include_once 'addressModel.php';
include_once 'orderModel.php';
use VOST\AddressModel;
use VOST\model\Utils;
use PDOException;
use VOST\OrderModel;
use VOST\SongModel;
use VOST\UserModel;
use VOST\VinylModel;

try {
    $pdo = Utils::dbConnect();
    echo '<pre>';


    echo "<h1>VINYLS</h1>";
    print_r(VinylModel::getVinyl($pdo,11));
    echo "<h1>USERS</h1>";
    print_r(UserModel::getUser($pdo,2001));
    echo "<h1>SONGS</h1>";
    print_r(SongModel::getSong($pdo,10));
    echo "<h1>ADDRESSES</h1>";
    print_r(AddressModel::getAddress($pdo,101));
    echo "<h1>ORDERS</h1>";
    print_r(OrderModel::getOrder($pdo,21));
    echo '</pre>';
} catch (PDOException $e) {
    echo ($e->getMessage());
}
