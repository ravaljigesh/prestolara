<?php

namespace App\Controllers\FrontControllers;

use App\Controllers\FrontController;

class JigeshravalController extends FrontController
{
    public function initContent()
    {
        return $this->template('prestolara/jigesh.tpl');
    }
}
