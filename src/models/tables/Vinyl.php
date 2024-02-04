<?php

namespace VOST\models\tables;

use PDO;
use PDOException;
use VOST\models\Utils;

include_once __DIR__ . '/Utils.php';

class Vinyl
{

    public $id_vinyl;
    public $name;
    public $stock;
    public $price;
    public $style;
    public $duration;
    public $max_duration;
    public $tableInfo;
    
    /**
     * constructFromArray
     *
     * @param  mixed $arr
     * @return Vinyl
     */
    public static function constructFromArray($arr) : Vinyl 
    {
        $values = array_values($arr);
        return new Vinyl(...$values);
    }
    
    /**
     * constructIdObject
     *
     * @param  mixed $id
     * @return Vinyl
     */
    public static function constructIdObject($id) : Vinyl
    {
        return new Vinyl($id, ...[null, null, null, null, null, null]);
    }


    
    /**
     * __construct
     *
     * @param  mixed $id_vinyl
     * @param  mixed $name
     * @param  mixed $stock
     * @param  mixed $price
     * @param  mixed $style
     * @param  mixed $duration
     * @param  mixed $max_duration
     * @return void
     */
    public function __construct($id_vinyl, $name, $stock, $price, $style, $duration, $max_duration)
    {
        $this->id_vinyl = $id_vinyl;
        $this->name = $name;
        $this->stock = $stock;
        $this->price = $price;
        $this->style = $style;
        $this->duration = $duration;
        $this->max_duration = $max_duration;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'vinyls', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }
}
