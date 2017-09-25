<?php

namespace App\Objects;

use App\Objects\IDB;

class Address extends IDB
{
    protected $table = 'address';

    protected $primaryKey = 'id_address';

    public function addAddress($address, $data = array())
    {
        if ($this->getAddress($address)) {
          return $this->getAddress($address);
        }

        if (!$data['alias']) {
            $data['alias'] = $data['type'] . ' Address';
        }

        $fields = [
            'id_country' => 21,
            'id_state' => $address->__st,
            'id_customer' => \Context::getContext()->cookie->id_customer,
            'company' => $address->__cn,
            'lastname' => $address->__ln,
            'firstname' => $address->__fn,
            'address1' => $address->__al1,
            'address2' => \Tools::getValue('__al2'),
            'postcode' => $address->__zi,
            'city' => $address->__ci,
            'phone' => $address->__nu,
            'date_add' => date('Y-m-d H:i:s'),
            'date_upd' => date('Y-m-d H:i:s'),
            'alias' => $data['alias'],
            'address_type' => $address->new_address_type
        ];

        \Db::getInstance()->insert('address', $fields);
        return \Db::getInstance()->Insert_ID();
    }

    public function updateCartAddress($id_cart, $id_address_delivery, $id_address_invoice)
    {
        $data = [
            'id_address_invoice' => $id_address_invoice,
            'id_address_delivery' => $id_address_delivery
        ];

        $where = 'id_cart = ' . $id_cart;

        \Db::getInstance()->update('cart', $data, $where);
        \Context::getContext()->cart->id_address_delivery = $id_address_delivery;
        \Context::getContext()->cart->id_address_invoice = $id_address_invoice;
        //Calculate tax based on address
        $ava = new \AvalaraTax;
        $ava->hookActionCartSave(['cart' => \Context::getContext()->cart]);
        \App\Classes\Factory::getFactory()->customer_checkout_information->updateAddress(\Context::getContext()->customer->id, $id_address_delivery, $id_address_invoice);
    }

    public function getAddress($address)
    {
        $address = $this->where('firstname', $address->__fn)
        ->where('lastname', $address->__ln)
        ->where('postcode', $address->__zi)
        ->where('city', $address->__ci)
        ->where('phone', $address->__nu)
        ->where('id_state', $address->__st)
        ->where('id_customer', \Context::getContext()->cookie->id_customer)
        ->where('company', $address->__cn)
        ->where('address_type', $address->new_address_type)
        ->first();
        if (isset($address->id_address)) {
          return $address->id_address;
        }

        return false;
    }

    public function state()
    {
        return $this->belongsTo('App\Objects\State', 'id_state', 'id_state');
    }
}
