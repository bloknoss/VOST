<?php

namespace VOST\models\tables;

use PDO;
use PDOException;
use VOST\models\Utils;

include_once __DIR__ . '/../Utils.php';


class CartVinyls
{

    public $id_user;
    public $id_vinyl;
    public $quantity;
    public $tableInfo;

    /**
     * constructFromArray
     *
     * @param  mixed $arr
     * @return CartVinyls
     */
    public static function constructFromArray($arr): CartVinyls
    {
        $values = array_values($arr);
        return new CartVinyls(...$values);
    }

    /**
     * constructIdObject
     *
     * @param  mixed $id
     * @return CartVinyls
     */
    public static function constructIdObject($id): CartVinyls
    {
        return new CartVinyls($id, ...[null, null, null, null, null, null]);
    }

    public function __construct($id_user, $id_vinyl, $quantity = 1)
    {
        $this->id_user = $id_user;
        $this->id_vinyl = $id_vinyl;
        $this->quantity = $quantity;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'carts_vinyls', 'tableValues' => $_values, 'tableFields' => Utils::getTableFields(($_values)),];
    }


    //Gettes & Setters

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getId_vinyl()
    {
        return $this->id_vinyl;
    }

    public function setId_vinyl($id_vinyl)
    {
        $this->id_vinyl = $id_vinyl;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}