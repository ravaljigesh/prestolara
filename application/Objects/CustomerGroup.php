<?php

namespace App\Objects;

use App\Objects\IDB;

class CustomerGroup extends IDB
{
    protected $table = 'customer_group';

    protected $primaryKey = 'id_customer';

    public function orders()
    {
        return $this->hasMany('App\Objects\Order', 'id_customer');
    }
}
