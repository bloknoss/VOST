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

    //Getters & Setters

    public function getIdSong()
    {
        return $this->id_song;
    }
    
    public function setIdSong($id_song)
    {
        $this->id_song = $id_song;
    }
    
    public function getArtist()
    {
        return $this->artist;
    }
    
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }
    
    public function getCompositor()
    {
        return $this->compositor;
    }
    
    public function setCompositor($compositor)
    {
        $this->compositor = $compositor;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getGenre()
    {
        return $this->genre;
    }
    
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }
    
    public function getDuration()
    {
        return $this->duration;
    }
    
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }
}