<?php

namespace VOST\models\tables;

use PDO;
use PDOException;
use VOST\models\Utils;

include_once __DIR__ . '/../DatabaseUtils.php';
include_once __DIR__ . '/../Utils.php';


class CartVinyls
{

    public $relation;
    public $id_user;
    public $id_vinyl;
    public $quantity;
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



    public function __construct($id_user, $id_vinyl, $quantity)
    {
        $this->id_user = $id_user;
        $this->id_vinyl = $id_vinyl;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'carts_vinyls', 'tableValues' => $_values,'tableFields' => Utils::getTableFields(array_splice($_values,1)),];
    }
}
