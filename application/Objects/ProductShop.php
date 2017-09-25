<?php

namespace App\Objects;

use App\Objects\IDB;

class ProductShop extends IDB
{
    protected $table = 'product_shop';

    protected $primaryKey = 'id_product';

    public $timestamp = false;
}
