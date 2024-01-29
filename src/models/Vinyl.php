<?php
namespace VOST\models;

include_once 'Utils.php';

class Vinyl
{

    public $id_vinyl;
    public $stock;
    public $price;
    public $style;
    public $duration;
    public $max_duration;
    public $tableInfo;

    public static function constructFromArray($arr)
    {
        $values = array_values($arr);
        return new Vinyl(...$values);
    }

        public static function constructIdObject($id)
    {
        return new Vinyl($id, ...[null, null, null, null, null, null]);
    }



    public function __construct($id_vinyl, $stock, $price, $style, $duration, $max_duration)
    {
        $this->id_vinyl = $id_vinyl;
        $this->stock = $stock;
        $this->price = $price;
        $this->style = $style;
        $this->duration = $duration;
        $this->max_duration = $max_duration;

        $_values = database\Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'vinyls', 'tableFields' => database\Utils::getTableFields($_values), 'tableValues' => $_values];
    }


}


