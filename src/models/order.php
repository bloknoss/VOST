<?php 

namespace VOST\models;


use VOST\models\Utils;
include_once 'utils.php';

class Order{

    public $id_order;
    public $id_address;
    public $date_time;
    public $tableInfo;

    public function __construct($id_order, $id_address, $date_time) {
        $this->id_order = $id_order;
        $this->id_address = $id_address;
        $this->date_time = $date_time;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'orders', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }
 
}