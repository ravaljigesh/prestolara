<?php

namespace App\Objects;

use App\Objects\IDB;

class StockAvailable extends IDB
{
    protected $table = 'stock_available';

    protected $primaryKey = 'id_product';

    public function products()
    {
        return $this->belongsToMany('App\Objects\Product', 'id_product');
    }

}
