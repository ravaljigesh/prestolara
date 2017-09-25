<?php

namespace App\Controllers\AdminControllers;

use App\Controllers\AdminController;

class JigeshravalController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function test()
    {
        return $this->template('view.tpl');
    }
}
