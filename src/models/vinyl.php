<?php
namespace VOST\models;

use VOST\models\Utils;

include_once 'utils.php';

class Vinyl
{

    public $id_vinyl;
    public $stock;
    public $price;
    public $style;
    public $duration;
    public $max_duration;
    public $tableInfo;

    public function __construct($id_vinyl, $stock, $price, $style, $duration, $max_duration)
    {
        $this->id_vinyl = $id_vinyl;
        $this->stock = $stock;
        $this->price = $price;
        $this->style = $style;
        $this->duration = $duration;
        $this->max_duration = $max_duration;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'vinyls', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }


}


