<?php

namespace VOST\models;

use VOST\models\Utils;

include_once 'utils.php';

include_once 'user.php';
include_once 'vinyl.php';
include_once 'song.php';
include_once 'address.php';
include_once 'order.php';

include_once 'userModel.php';
include_once 'vinylModel.php';
include_once 'songModel.php';
include_once 'addressModel.php';
include_once 'orderModel.php';

use VOST\models\User;
use VOST\models\Vinyl;
use VOST\models\Order;
use VOST\models\Address;
use VOST\models\Song;


use PDOException;

use VOST\models\AddressModel;
use VOST\models\OrderModel;
use VOST\models\SongModel;
use VOST\models\VinylModel;
use VOST\models\UserModel;

try {
    $pdo = Utils::dbConnect();
    echo '<pre>';

    $abstracted = Address::constructIdObject(111);

    print_r(AddressModel::getAddresses($pdo, $abstracted));

    echo '</pre>';

} catch (PDOException $e) {
    echo ($e->getMessage());
}

//echo "<h1>VINYLS</h1>";
//print_r(VinylModel::getVinyl($pdo, 11));
//echo "<h1>USERS</h1>";
//print_r(UserModel::getUser($pdo, 2001));
//echo "<h1>SONGS</h1>";
//print_r(SongModel::getSong($pdo, 10));
//echo "<h1>ADDRESSES</h1>";
//print_r(AddressModel::getAddress($pdo, 101));
//echo "<h1>ORDERS</h1>";
//print_r(OrderModel::getOrder($pdo, 21));
