<?php

namespace App\Objects;

use App\Objects\IDB;

class Order extends IDB
{
    protected $table = 'orders';

    protected $primaryKey = 'id_order';

    public function cart()
    {
        return $this->belongsTo('App\Objects\Cart', 'id_cart');
    }

    public function products()
    {
        return $this->hasMany('App\Objects\OrderDetail', 'id_order');
        // return $this->belongsToMany('App\Objects\ProductAttribute', 'order_detail', 'id_order', 'id_product_attribute');
    }

    public function customer()
    {
        return $this->belongsTo('App\Objects\Customer', 'id_customer');
    }

    public function getProductsTotal()
    {
        $products_total = 0;
        $products = $this->products;
        if (count($products)) {
          foreach ($products as $product) {
            $products_total += $product['product_price'];
          }
        }
        return $products_total;
    }
}
