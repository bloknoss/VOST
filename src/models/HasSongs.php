<?php
namespace VOST\models;

include_once 'Utils.php';

class HasSongs
{

    public $id_vinyl;
    public $id_song;
    public $tableInfo;

    public static function constructFromArray($arr)
    {
        $values = array_values($arr);
        return new Song(...$values);
    }

    public static function constructIdObject($id)
    {
        return new Song($id, ...[null, null, null, null, null, null]);
    }



    public function __construct($id_vinyl, $id_song)
    {
        $this->id_vinyl = $id_vinyl;
        $this->id_song = $id_song;

        $_values = database\Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'has_songs', 'tableFields' => database\Utils::getTableFields($_values), 'tableValues' => $_values];
    }


}


