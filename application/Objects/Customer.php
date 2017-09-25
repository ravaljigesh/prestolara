<?php

namespace App\Objects;

use App\Objects\IDB;

class Customer extends IDB
{
    protected $table = 'customer';

    protected $primaryKey = 'id_customer';

    public function orders()
    {
        return $this->hasMany('App\Objects\Order', 'id_customer');
    }

    public function address()
    {
        return $this->hasMany('App\Objects\Address', 'id_customer');
    }

    public function shipping_address()
    {
        return $this->belongsToMany('App\Objects\Address', 'customer_checkout_information', 'id_customer', 'id_address_delivery')->first();
    }

    public function invoice_address()
    {
        return $this->belongsToMany('App\Objects\Address', 'customer_checkout_information', 'id_customer', 'id_address_invoice')->first();
    }

    public function checkout_information()
    {
        return $this->belongsTo('App\Objects\CustomerCheckoutInformation', 'id_customer', 'id_customer');
    }

    public function payment_profile()
    {
        return $this->hasMany('App\Objects\CustomerPaymentProfile', 'id_customer', 'id_customer');
    }
}
