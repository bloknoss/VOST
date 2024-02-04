<?php

namespace VOST\models\tables;


use VOST\models\Utils;

include_once __DIR__ . '/../Utils.php';

class Order
{

    public $id_order;
    public $id_address;
    public $date_time;
    public $tableInfo;
    
    /**
     * constructFromArray
     *
     * @param  mixed $arr
     * @return Order
     */
    public static function constructFromArray($arr) : Order
    {
        $values = array_values($arr);
        return new Order(...$values);
    }
    
    /**
     * constructIdObject
     *
     * @param  mixed $id
     * @return Order
     */
    public static function constructIdObject($id) : Order
    {
        return new Order($id, ...[null, null, null, null, null, null]);
    }

    
    /**
     * __construct
     *
     * @param  mixed $id_order
     * @param  mixed $id_address
     * @param  mixed $date_time
     * @return void
     */
    public function __construct($id_order, $id_address, $date_time)
    {
        $this->id_order = $id_order;
        $this->id_address = $id_address;
        $this->date_time = $date_time;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'orders', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }
}
