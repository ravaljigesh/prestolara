<?php

namespace App\Objects;

use App\Objects\IDB;

class AffiliateReferrals extends IDB
{
    protected $table = 'affiliate_referrals';

    public $guarded = [];

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo('App\Objects\Customer', 'id_customer', 'id_customer');
    }
}
