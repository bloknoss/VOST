<?php

namespace VOST\models;

use VOST\models\tables\Song;
use VOST\models\Utils;

include_once __DIR__ . '/../Utils.php';
include_once __DIR__ . '/Song.php';

class HasSongs
{

    public $id_vinyl;
    public $id_song;
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
     * @param  mixed $id_vinyl
     * @param  mixed $id_song
     * @return void
     */
    public function __construct($id_vinyl, $id_song)
    {
        $this->id_vinyl = $id_vinyl;
        $this->id_song = $id_song;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'has_songs', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }

    // Getters & Setters

    public function getIdVinyl()
    {
        return $this->id_vinyl;
    }
    
    public function setIdVinyl($id_vinyl)
    {
        $this->id_vinyl = $id_vinyl;
    }

    public function getIdSong()
    {
        return $this->id_song;
    }
    
    public function setIdSong($id_song)
    {
        $this->id_song = $id_song;
    }
}
