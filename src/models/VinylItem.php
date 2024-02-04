<?php

namespace VOST\models;

use VOST\models\tables\Vinyl;

class VinylItem
{
    public Vinyl $vinyl;
    public int $quantity;

    /**
     * @param Vinyl $vinyl
     * @param int $cuantity
     */
    public function __construct(Vinyl $vinyl, int $cuantity)
    {
        $this->vinyl = $vinyl;
        $this->quantity = $cuantity;
    }


}