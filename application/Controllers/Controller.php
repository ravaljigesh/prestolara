<?php

namespace App\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function initContent()
    {
        return 'Configuration! LaraPresto is working. Define new route in application/Routes/Web.php';
    }
}
