<?php

namespace VOST\models;


include_once 'Utils.php';

class Order
{

    public $id_order;
    public $id_address;
    public $date_time;
    public $tableInfo;

    public static function constructFromArray($arr)
    {
        $values = array_values($arr);
        return new Order(...$values);
    }

    public static function constructIdObjectqqqqqq($id)
    {
        return new Order($id, ...[null, null, null, null, null, null]);
    }


    public function __construct($id_order, $id_address, $date_time)
    {
        $this->id_order = $id_order;
        $this->id_address = $id_address;
        $this->date_time = $date_time;

        $_values = database\Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'orders', 'tableFields' => database\Utils::getTableFields($_values), 'tableValues' => $_values];
    }

}