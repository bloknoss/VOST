<?php



namespace VOST\models;

use VOST\models\database\Utils;

include_once 'Utils.php';

class Address
{
    public $id_address;
    public $id_user;
    public $postal_code;
    public $city;
    public $street;
    public $number;
    public $tableInfo;


    public static function constructFromArray($arr)
    {
        $values = array_values($arr);
        return new Address(...$values);
    }

    public static function constructIdObject($id)
    {
        return new Address($id, ...[null, null, null, null, null, null]);
    }



    public function __construct($id_address, $id_user, $postal_code, $city, $street, $number)
    {
        $this->id_address = $id_address;
        $this->id_user = $id_user;
        $this->postal_code = $postal_code;
        $this->city = $city;
        $this->street = $street;
        $this->number = $number;


        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'address', 'tableFields' => database\Utils::getTableFields($_values), 'tableValues' => $_values];
    }

}