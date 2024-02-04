<?php

namespace VOST\models;

use VOST\models\Utils;
use VOST\models\tables\Vinyl;

include_once __DIR__ . '/Vinyl.php';
include_once __DIR__ . '/../Utils.php';

class VinylsOrdered
{

    public $id_vinyl;
    public $id_order;
    public $number;
    public $tableInfo;
    
    /**
     * constructFromArray
     *
     * @param  mixed $arr
     * @return VinylsOrdered
     */
    public static function constructFromArray($arr) : VinylsOrdered
    {
        $values = array_values($arr);
        return new VinylsOrdered(...$values);
    }
    
    /**
     * constructIdObject
     *
     * @param  mixed $id
     * @return VinylsOrdered
     */
    public static function constructIdObject($id) : VinylsOrdered
    {
        return new VinylsOrdered($id, ...[null, null, null, null, null, null]);
    }



    public function __construct($id_vinyl, $id_order, $number)
    {
        $this->id_vinyl = $id_vinyl;
        $this->id_order = $id_order;
        $this->number = $number;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'vinyls_ordered', 'tableValues' => $_values, 'tableFields' => Utils::getTableFields(($_values)),];
    }
}
