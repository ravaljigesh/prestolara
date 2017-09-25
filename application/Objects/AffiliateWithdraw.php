<?php
namespace App\Objects;

use App\Objects\IDB;
use Illuminate\Support\Facades\DB;

class AffiliateWithdraw extends IDB
{
    protected $table = 'affiliate_withdraw';

    // protected $primaryKey = 'id_customer';

    public $guarded = [];

    public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo('App\Objects\Customer', 'id_customer', 'id_customer');
    }

    public function withdraw_details()
    {
        return $this->hasMany('App\Objects\AffiliateWithdrawDetails', 'id_request', 'id');
    }
}
