<?php

namespace VOST\models;

use VOST\models\Utils;

include_once __DIR__ . '/utils.php';

class User
{

    public $id_user;
    public $name;
    public $email;
    public $password;
    public $tableInfo;


    public static function constructFromArray($arr): User|null
    {
        if (!$arr) {
            return null;
        }
        $values = array_values($arr);
        return new User(...$values);
    }

    public static function constructIdObject($id): User
    {
        return new User($id, ...[null, null, null, null, null, null]);
    }

    public static function constructLoginObject($value, $tableIdentifier): User
    {
        $tables = ['email', 'name'];
        $user = self::constructIdObject(0);
        $user->tableInfo["tableFields"][0] = $tables[$tableIdentifier];
        $user->tableInfo["tableValues"][$tables[$tableIdentifier]] = $value;
        return $user;
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
