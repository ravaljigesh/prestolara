<?php

namespace App\Objects;

use App\Objects\IDB;

class CustomerCheckoutInformation extends IDB
{
    protected $table = 'customer_checkout_information';

    protected $primaryKey = 'id_customer';

    public function updateAddress($id_customer, $id_address_delivery = 0, $id_address_invoice = 0)
    {
        $cci = CustomerCheckoutInformation::find($id_customer);

        if (!isset($cci->id_checkout)) {
          $cci = new CustomerCheckoutInformation;
          $cci->id_customer = $id_customer;
        }
        $cci->id_address_invoice = $id_address_invoice;
        $cci->id_address_delivery = $id_address_delivery;
        $cci->save();
        return $cci;
    }
}
