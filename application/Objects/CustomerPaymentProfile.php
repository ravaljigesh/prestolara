<?php

namespace App\Objects;

use App\Objects\IDB;

class CustomerPaymentProfile extends IDB
{
    protected $table = 'customer_payment_profile';

    protected $primaryKey = 'id_customer';
}
