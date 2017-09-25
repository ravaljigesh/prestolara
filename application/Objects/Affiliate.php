<?php

namespace App\Objects;

use App\Objects\IDB;

class Affiliate extends IDB
{
    protected $table = 'affiliate';

    protected $primaryKey = 'id_customer';

    public $guarded = [];

    public function orders()
    {
        return $this->belongsToMany('App\Objects\Order', 'affiliate_bonus', 'id_sponsor', 'id_order');
    }

    public function referrals()
    {
        return $this->belongsToMany('App\Objects\Customer', 'affiliate_referrals', 'id_sponsor', 'id_customer');
    }

    public function getTotalSales()
    {
        $total_sales = 0;
        $referrals = $this->referrals;
        if (count($referrals)) {
          foreach ($referrals as $ref) {
            if (count($ref)) {
              foreach ($ref->orders as $order) {
                $total_sales += $order->total_products;
              }
            }
          }
        }
        return $total_sales;
    }

    public function getEarning()
    {
        return $this->affiliate_bonus->where('payment_status', '!=', 'Paid')->sum('sum');
    }

    public function getTotalSalesThroughAffiliates()
    {
        $affiliates = $this->all();
        $data['total_products'] = 0;
        $data['total_shipping'] = 0;
        if (count($affiliates)) {
          foreach ($affiliates as $affiliate) {
            foreach ($affiliate->orders as $order) {
              $data['total_products'] += $order->total_products;
              $data['total_shipping'] += $order->total_shipping_tax_incl;
            }
          }
        }
        return $data;
    }

    public function getLevel($sales = null)
    {
        if (!$sales) {
          $sales = $this->getTotalSales();
        }
        if ($sales <= 250000) {
          return '5';
        }

        if ($sales >= 251000 && $sales <= 500000) {
          return '7';
        }

        if ($sales >= 500001 && $sales <= 1000000) {
          return '10';
        }
    }

    public function withdrawal_requests()
    {
        return $this->hasMany('App\Objects\AffiliateWithdraw', 'id_customer', 'id_customer');
    }

    public function getTotalPayment($paid = true)
    {
          if ($paid) {
          return $this->withdrawal_requests->where('status', 1)->sum('amount');
        }

        return $this->withdrawal_requests->where('status', 0)->sum('amount');
    }

    public function affiliate_bonus()
    {
        return $this->hasMany('App\Objects\AffiliateBonus', 'id_sponsor', 'id_customer');
    }

    public function getEligibleAmount()
    {
        return $this->affiliate_bonus->where('payment_status', 'Unpaid')->sum('sum');
    }

    public function sendAffiliateEmail($customer)
    {
        \Mail::send(1, 'affiliate_approved', 'About your affiliate application at balingwiredirect.com', [
          'firstname' => $customer->firstname,
          'lastname' => $customer->lastname,
          'email' => 'jigeshraval89@gmail.com',
          'shop' => \Context::getContext()->shop->name,
          'url' => \Context::getContext()->shop->domain . '/affiliate/login',
          'base_url' => \Context::getContext()->shop->domain
        ], $customer->email, $customer->firstname);
    }

    public function withdraw()
    {
        return $this->hasMany('App\Objects\AffiliateWithdraw', 'id_customer', 'id_customer');
    }

    public function customer()
    {
        return $this->belongsTo('App\Objects\Customer', 'id_customer', 'id_customer');
    }
}
