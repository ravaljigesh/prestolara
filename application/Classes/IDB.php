<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class IDB extends Capsule
{
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new IDB();
        }

        return self::$instance;
    }

    public function connect()
    {
        $ps = include(_PS_ROOT_DIR_ . '/app/config/parameters.php');
        if (isset($ps['parameters'])) {
          $ps = $ps['parameters'];
        }
        $capsule = new IDB;
        $capsule->addConnection([
          'driver' => 'mysql',
          'host' => $ps['database_host'],
          'database' => $ps['database_name'],
          'username' => $ps['database_user'],
          'password' => $ps['database_password'],
          'charset' => 'utf8',
          'collation' => 'utf8_unicode_ci',
          'prefix' => $ps['database_prefix']
        ]);

        $capsule->setAsGlobal();
        // Setup the Eloquent ORM…
        $capsule->bootEloquent();

        return $capsule;
    }

    public static function test()
    {
        echo 'working';
        exit();
    }
}
