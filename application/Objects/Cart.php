<?php

namespace App\Objects;

use App\Objects\IDB;

class Cart extends IDB
{
    protected $table = 'cart';

    protected $primaryKey = 'id_cart';

    public function products()
    {
        return $this->belongsToMany('App\Objects\ProductLang', 'cart_product', 'id_cart', 'id_product');
    }

    public function getShippingMethods()
    {
        $context = \Context::getContext();
        $total = $context->cart->getOrderTotal(true, \Cart::ONLY_PRODUCTS_WITHOUT_SHIPPING);
        $factory = \App\Classes\Factory::getFactory();
        $standard_shipping = $factory->carrier->fetch('name', 'Standard Shipping');
        $express_shipping = $factory->carrier->fetch('name', 'Express Shipping');

        $methods['Standard Shipping'] = $standard_shipping;
        $methods['Standard Shipping']['price'] = 0;
        $methods['Standard Shipping']['delay'] = $standard_shipping->lang->delay;
        $methods['Express Shipping'] = $express_shipping;
        $methods['Express Shipping']['delay'] = $express_shipping->lang->delay;
        $methods['Express Shipping']['price'] = 0;

        if ($total >= 10 && $total <= 1000) {
          $methods['Standard Shipping']['price'] = 70;
        }

        if ($total >= 1001 && $total <= 5000) {
          $methods['Standard Shipping']['price'] = 120;
          $methods['Express Shipping']['price'] = 200;
        }

        if ($total >= 5001 && $total <= 10000) {
          $methods['Standard Shipping']['price'] = 150;
          $methods['Express Shipping']['price'] = 400;
        }

        if ($total >= 10001 && $total <= 20000) {
          $methods['Standard Shipping']['price'] = 200;
          $methods['Express Shipping']['price'] = 500;
        }

        if ($total >= 20001 && $total <= 30000) {
          $methods['Standard Shipping']['price'] = 200;
        }

        $cart = $factory->cart;
        $carrier = $factory->carrier->find($context->cart->id_carrier);
        if (isset($carrier->id_carrier) && $carrier->id_carrier) {
          $cart->shipping_cost = $methods[$carrier->name]['price'];
        } else {
          $cart->id_carrier = $standard_shipping->id_carrier;
          $cart->shipping_cost = $methods['Standard Shipping']['price'];
        }
        $cart->save();
        // pre($cart);
        return $methods;
    }

    public function order()
    {
        return $this->belongsTo('App\Objects\Order', 'id_cart', 'id_cart');
    }
}
