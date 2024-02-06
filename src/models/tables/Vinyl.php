<?php

namespace VOST\models\tables;

use PDO;
use PDOException;
use VOST\models\Utils;



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
     * @param mixed $arr
     * @return Vinyl
     */
    public static function constructFromArray($arr): Vinyl|null
    {
        if ($arr === 0 || $arr === -1)
            return null;

        $values = array_values($arr);
        return new Vinyl(...$values);
    }

    /**
     * constructIdObject
     *
     * @param mixed $id
     * @return Vinyl
     */
    public static function constructIdObject($id): Vinyl
    {
        return new Vinyl($id, ...[null, null, null, null, null, null]);
    }


    /**
     * __construct
     *
     * @param mixed $id_vinyl
     * @param mixed $name
     * @param mixed $stock
     * @param mixed $price
     * @param mixed $style
     * @param mixed $duration
     * @param mixed $max_duration
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

    //Getters & Setters

    public function getIdVinyl()
    {
        return $this->id_vinyl;
    }

    public function setIdVinyl($id_vinyl)
    {
        $this->id_vinyl = $id_vinyl;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function setStyle($style)
    {
        $this->style = $style;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getMax_duration()
    {
        return $this->max_duration;
    }

    public function setMax_duration($max_duration)
    {
        $this->max_duration = $max_duration;
    }
}
