<?php

namespace VOST\models;

use PDO;
use PDOException;

include_once 'Database.php';

class CartVinyls
{

    public $id_user;
    public $id_vinyl;
    public $tableInfo;

    public static function constructFromArray($arr): CartVinyls
    {
        $values = array_values($arr);
        return new CartVinyls(...$values);
    }

    public static function constructIdObject($id): CartVinyls
    {
        return new CartVinyls($id, ...[null, null, null, null, null, null]);
    }



    public function __construct($id_user, $id_vinyl)
    {
        $this->id_user = $id_user;
        $this->id_vinyl = $id_vinyl;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'carts_vinyls', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }
}
