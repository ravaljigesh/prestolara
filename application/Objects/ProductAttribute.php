<?php

namespace App\Objects;

use App\Objects\IDB;

class ProductAttribute extends IDB
{
    protected $table = 'product_attribute';

    protected $primaryKey = 'id_product_attribute';

    public function product()
    {
        return $this->belongsTo('App\Objects\Product', 'id_product');
    }

    public function product_lang()
    {
        return $this->belongsTo('App\Objects\ProductLang', 'id_product');
    }
}
