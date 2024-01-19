<?php
namespace VOST\models;

use VOST\models\Utils;

include_once 'utils.php';

class VinylsOrdered
{

    public $id_vinyl;
    public $id_order;
    public $number;

    public static function constructFromArray($arr)
    {
        $values = array_values($arr);
        return new Vinyl(...$values);
    }

    public static function constructIdObject($id)
    {
        return new Vinyl($id, ...[null, null, null, null, null, null]);
    }



    public function __construct($id_vinyl, $id_order, $number)
    {
        $this->id_vinyl = $id_vinyl;
        $this->id_order = $id_order;
        $this->number = $number;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'vinyls_ordered', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }


}


