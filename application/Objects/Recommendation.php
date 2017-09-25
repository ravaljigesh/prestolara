<?php

namespace App\Objects;

use App\Objects\IDB;

class Recommendation extends IDB
{
    protected $table = 'bestkit_page_views';

    protected $primaryKey = 'id_bestkit_views';

    public function product()
    {
        return $this->hasMany('App\Objects\Product', 'id_product', 'id_product');
    }
}
