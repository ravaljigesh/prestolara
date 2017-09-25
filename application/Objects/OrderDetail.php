<?php

namespace App\Objects;

use App\Objects\IDB;

class OrderDetail extends IDB
{
    protected $table = 'order_detail';

    protected $primaryKey = 'id_order_detail';
}
