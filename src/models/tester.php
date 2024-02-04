<?php

namespace VOST\models;

use VOST\models\database\DatabaseUtils;
use VOST\models\tables\Address;
use VOST\models\tables\CartVinyls;
use VOST\models\tables\Order;
use VOST\models\tables\User;
use VOST\models\tables\Vinyl;
use VOST\models\tables\Song;


include_once __DIR__ . '/database/DatabaseUtils.php';
include_once __DIR__ . '/database/QueryUtils.php';
include_once __DIR__ . '/tables/CartVinyls.php';
include_once __DIR__ . '/tables/Order.php';
include_once __DIR__ . '/tables/User.php';
include_once __DIR__ . '/tables/Vinyl.php';
include_once __DIR__ . '/tables/Song.php';
include_once __DIR__ . '/tables/Address.php';

include_once __DIR__ . '/AddressModel.php';
include_once __DIR__ . '/CartModel.php';
include_once __DIR__ . '/OrderModel.php';
include_once __DIR__ . '/UserModel.php';
include_once __DIR__ . '/VinylModel.php';
include_once __DIR__ . '/SongModel.php';

class ModelUnitTesting
{
    // Class in which we'll test the methods of the classes in the models folder
    // Each Model has a CRUD which is tested here, by using the getItems, getItem, insertItem, updateItem, and deleteItem methods from the DatabaseUtils class
    // The methods are tested by using the QueryUtils class to create a table, insert data into it, and then test the CRUD methods, they will make sure that none of the return are null, not the results.
    public static function test(): array
    {
        $results = [];
        // We initialize 5 Model objects corresponding to the 5 tables in the database
        // We then test the CRUD methods of each of these models

        $user = new User(2002, "test", "email.com", "password", 1);
        $order = new Order(21, 20, 20);
        $vinyl = new Vinyl(20, "test", "test", "test", "idk", 5, 5);
        $song = new Song(20, "pepe", "Ludwig", "no1clue", "test", 20);
        $address = new Address(101, "e", "1510", "x", "x", 10);
        $cart = new CartVinyls(20, 20, 20);

        $pdo = DatabaseUtils::dbConnect();

        $queryResults = UserModel::getUser($pdo, $user);
        $results[] = $queryResults;
        $queryResults = VinylModel::getVinyl($pdo, $vinyl);
        $results[] = $queryResults;
        $queryResults = OrderModel::getOrder($pdo, $order);
        $results[] = $queryResults;
        $queryResults = AddressModel::getAddress($pdo, $address);
        $results[] = $queryResults;
        $queryResults = SongModel::getSong($pdo, $song);
        $results[] = $queryResults;
        return $results;
    }
}



echo '<pre>';
print_r(ModelUnitTesting::test());
echo '</pre>';
