<?php

namespace VOST\models\tables;

use VOST\models\Utils;

class Address
{
    public $id_address;
    public $id_user;
    public $postal_code;
    public $city;
    public $street;
    public $number;
    public $tableInfo;

    
    /**
     * constructFromArray
     *
     * @param  mixed $arr
     * @return Address
     */
    public static function constructFromArray($arr) : Address
    {
        $values = array_values($arr);
        return new Address(...$values);
    }
    
    /**
     * constructIdObject
     *
     * @param  mixed $id
     * @return Address
     */
    public static function  constructIdObject($id) : Address
    {
        return new Address($id, ...[null, null, null, null, null, null]);
    }


    
    /**
     * __construct
     *
     * @param  mixed $id_address
     * @param  mixed $id_user
     * @param  mixed $postal_code
     * @param  mixed $city
     * @param  mixed $street
     * @param  mixed $number
     * @return void
     */
    public function __construct($id_address, $id_user, $postal_code, $city, $street, $number)
    {
        $this->id_address = $id_address;
        $this->id_user = $id_user;
        $this->postal_code = $postal_code;
        $this->city = $city;
        $this->street = $street;
        $this->number = $number;


        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'addresses', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }
}
