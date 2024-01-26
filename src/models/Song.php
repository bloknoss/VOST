<?php

namespace VOST\models;

use VOST\models\Utils;

include_once 'Utils.php';

class Song
{
    public $id_song;
    public $artist;
    public $compositor;
    public $name;
    public $genre;
    public $duration;
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



    public function __construct($id_song, $artist, $compositor, $name, $genre, $duration)
    {
        $this->id_song = $id_song;
        $this->artist = $artist;
        $this->compositor = $compositor;
        $this->name = $name;
        $this->genre = $genre;
        $this->duration = $duration;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'songs', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }
}