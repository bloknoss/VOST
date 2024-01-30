<?php
namespace VOST\models;

use PDO;
use PDOException;
use VOST\models\Utils;

include_once 'Utils.php';

class Vinyl
{

    public $id_vinyl;
    public $stock;
    public $price;
    public $style;
    public $duration;
    public $max_duration;
    public $tableInfo;

    public static function constructFromArray($arr)
    {
        $values = array_values($arr);
        return new Vinyl(...$values);
    }

    public static function constructIdObject($id)
    {
        return new Vinyl($id, ...[null, null, null, null, null, null]);
    }



    public function __construct($id_vinyl, $stock, $price, $style, $duration, $max_duration)
    {
        $this->id_vinyl = $id_vinyl;
        $this->stock = $stock;
        $this->price = $price;
        $this->style = $style;
        $this->duration = $duration;
        $this->max_duration = $max_duration;

        $_values = Utils::getValuesArray($this);
        $this->tableInfo = ['tableName' => 'vinyls', 'tableFields' => Utils::getTableFields($_values), 'tableValues' => $_values];
    }

    public function getOrderedVinyls($pdo)
    {
        try {
            $query = "select * from vinyls_ordered where id_vinyl=:id_vinyl";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_vinyl", $this->id_vinyl);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {

        }
    }

    public function getHasSongs($pdo)
    {
        try {
            $query = "select * from has_songs where id_vinyl=:id_vinyl";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id_vinyl", $this->id_vinyl);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {

        }
    }


}


