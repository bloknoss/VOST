<?php

namespace VOST\models;

use VOST\models\Utils;

include_once 'utils.php';

class User
{

    public $id_user;
    public $name;
    public $email;
    public $password;
    public $tableInfo;

    public static function constructFromArray($arr)
    {
        $values = array_values($arr);
        return new User(...$values);
    }

    public static function constructIdObject($id)
    {
        return new User($id, ...[null, null, null, null, null, null]);
    }


    public function __construct($id_user, $name, $email, $password)
    {
        $this->id_user = $id_user;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'users', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }
}
