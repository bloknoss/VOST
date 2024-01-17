<?php
namespace VOST\models;

use VOST\models\Utils;
use VOST\models\Database;

include_once 'utils.php';
include_once 'database.php';

class User
{

    public $id_user;
    public $name;
    public $email;
    public $password;
    public $tableInfo;

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
