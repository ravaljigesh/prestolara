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
        $capsule = new IDB;
        $capsule->addConnection([
          'driver' => 'mysql',
          'host' => '127.0.0.1',
          'database' => 'mymusic_dev',
          'username' => 'mymusic_jigesh',
          'password' => 'Ravalera1#',
          'charset' => 'utf8',
          'collation' => 'utf8_unicode_ci',
          'prefix' => 'ms_'
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
