<?php 

namespace VOST\models;
use VOST\models\Utils;
include_once 'utils.php';

class Song{
    public $id_song;
    public $artist;
    public $compositor;
    public $name;
    public $genre;
    public $duration;
    public $tableInfo;

    public function __construct($id_song, $artist, $compositor, $name, $genre, $duration) {
        $this->id_song =$id_song;
        $this->artist = $artist;
        $this->compositor = $compositor;
        $this->name = $name;
        $this->genre = $genre;
        $this->duration = $duration;
        
        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'songs', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }
}