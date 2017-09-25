<?php

namespace App\Objects;

use App\Objects\IDB;

class ProductLang extends IDB
{
    protected $table = 'product_lang';

    protected $primaryKey = 'id_product';
}
