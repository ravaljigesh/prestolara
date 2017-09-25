<?php

namespace App\Objects;

use App\Objects\IDB;

class CartProduct extends IDB
{
    protected $table = 'cart_product';

    protected $primaryKey = 'id_cart';

    public function products()
    {
        return $this->belongsToMany('App\Objects\ProductLang', 'cart_product', 'id_cart', 'id_product');
    }
}
