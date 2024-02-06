<?php

namespace VOST\models\tables;

use VOST\models\Utils;

class User
{

    public $id_user;
    public $name;
    public $email;
    public $password;
    public $is_active;
    public $tableInfo;

    
    /**
     * constructFromArray
     *
     * @param  mixed $arr
     * @return User
     */
    public static function constructFromArray($arr): User|null
    {
        if (!$arr) {
            return null;
        }
        $values = array_values($arr);
        return new User(...$values);
    }
    
    /**
     * constructIdObject
     *
     * @param  mixed $id
     * @return User
     */
    public static function constructIdObject($id): User
    {
        return new User($id, ...[null, null, null]);
    }
    
    /**
     * constructLoginObject
     *
     * @param  mixed $value
     * @param  mixed $tableIdentifier
     * @return User
     */
    public static function constructLoginObject($value, $tableIdentifier): User
    {
        $tables = ['email', 'name'];
        $user = self::constructIdObject(0);
        $user->tableInfo["tableFields"][0] = $tables[$tableIdentifier];
        $user->tableInfo["tableValues"][$tables[$tableIdentifier]] = $value;
        return $user;
    }


    public function __construct($id_user, $name, $email, $password, $is_active = false)
    {
        $this->id_user = $id_user;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->is_active = $is_active;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'users', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }

    //Getters & Setters

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getIsActive()
    {
        return $this->is_active;
    }

    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;
    }

}
