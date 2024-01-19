<?php
namespace VOST\models;

use VOST\models\Utils;

include_once 'utils.php';

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

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'has_songs', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }


}


