<?php

namespace VOST\models\tables;

use VOST\models\Utils;

include_once __DIR__ . '/Utils.php';

class Song
{
    public $id_song;
    public $artist;
    public $compositor;
    public $name;
    public $genre;
    public $duration;
    public $tableInfo;
    
    /**
     * constructFromArray
     *
     * @param  mixed $arr
     * @return Song
     */
    public static function constructFromArray($arr) : Song
    {
        $values = array_values($arr);
        return new Song(...$values);
    }
    
    /**
     * constructIdObject
     *
     * @param  mixed $id
     * @return Song
     */
    public static function constructIdObject($id) : Song
    {
        return new Song($id, ...[null, null, null, null, null, null]);
    }


    
    /**
     * __construct
     *
     * @param  mixed $id_song
     * @param  mixed $artist
     * @param  mixed $compositor
     * @param  mixed $name
     * @param  mixed $genre
     * @param  mixed $duration
     * @return void
     */
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