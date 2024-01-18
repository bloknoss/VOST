<?php
namespace VOST\models;

use VOST\models\Utils;

include_once 'utils.php';

class Vinyl
{

    public $id_vinyl;
    public $id_order;
    public $number;

    public function __construct($id_vinyl, $id_order, $number)
    {
        $this->id_vinyl = $id_vinyl;
        $this->id_order = $id_order;
        $this->number = $number;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'vinyls_ordered', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }


}


