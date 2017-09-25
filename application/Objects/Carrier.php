<?php

namespace App\Objects;

use App\Objects\IDB;

class Carrier extends IDB
{
    protected $table = 'carrier';

    protected $primaryKey = 'id_carrier';

    public function lang()
    {
        return $this->belongsTo('App\Objects\CarrierLang', 'id_carrier');
    }
}
