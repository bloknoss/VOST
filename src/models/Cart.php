<?php

namespace VOST\models;

use VOST\models\Utils;

include_once 'Utils.php';

class Cart
{

    public $id_cart;
    public $id_vinyl;
    public $quantity;
    public $tableInfo;

    public static function constructFromArray($arr): Cart
    {
        $values = array_values($arr);
        return new Cart(...$values);
    }

    public static function constructIdObject($id): Cart
    {
        return new Cart($id, ...[null, null, null, null, null, null]);
    }



    public function __construct($id_cart, $id_vinyl, $quantity)
    {
        $this->id_cart = $id_cart;
        $this->id_vinyl = $id_vinyl;
        $this->quantity = $quantity;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'addresses', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }
}
