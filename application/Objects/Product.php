<?php

namespace App\Objects;

use App\Objects\IDB;

class Product extends IDB
{
    protected $table = 'product';

    protected $primaryKey = 'id_product';

    public $timestamp = false;

    public function category_related()
    {
        return $this->hasMany('App\Objects\ProductShop', 'id_category_default', 'id_category_default');
    }
}
