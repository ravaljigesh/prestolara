<?php

namespace App\Objects;

use App\Objects\IDB;

class AffiliateCustomer extends IDB
{
    protected $table = 'refpro_customer';

    public function products()
    {
        return $this->belongsToMany('App\Objects\ProductLang', 'cart_product', 'id_cart', 'id_product');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Objects\Order', 'refpro_bonus', 'id_customer', 'id_order', 'sponsor');
    }
}
