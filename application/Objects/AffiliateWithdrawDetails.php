<?php

namespace App\Objects;

use App\Objects\IDB;

class AffiliateWithdrawDetails extends IDB
{
    protected $table = 'affiliate_withdraw_details';

    protected $primaryKey = 'id_request';

    public function order()
    {
        return $this->belongsTo('App\Objects\Order', 'id_order');
    }
}
