<?php
namespace VOST\models;

use VOST\models\Utils;

include_once 'utils.php';

class Vinyl
{

    public $id_vinyl;
    public $id_song;
    public $tableInfo;

    public function __construct($id_vinyl, $id_song)
    {
        $this->id_vinyl = $id_vinyl;
        $this->id_song = $id_song;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'has_songs', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }


}


