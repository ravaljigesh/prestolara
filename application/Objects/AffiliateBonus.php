<?php

namespace App\Objects;

use App\Objects\IDB;

class AffiliateBonus extends IDB
{
    protected $table = 'affiliate_bonus';

    protected $primaryKey = 'id_sponsor';

    public $guarded = [];

    public $timestamps = false;
}
