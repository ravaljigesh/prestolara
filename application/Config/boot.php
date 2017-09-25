<?php
Illuminate\Support\ClassLoader::register();
use Symfony\Component\Debug\Debug;

$basePath = _PS_ROOT_DIR_ . '/application';
require $basePath . '/helper.php';

$app = new Illuminate\Container\Container();
$app->bind('app', $app);
\App\Classes\IDB::getInstance()->connect();

$app->bind('path.base', $basePath);

Illuminate\Support\Facades\Facade::setFacadeApplication($app);

// register application instance with container
$app['app'] = $app;

// set environment
$app['env'] = 'production';

with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();

// $router = $app['router'];
$request = Illuminate\Http\Request::createFromGlobals();
if (isset($admin) && $admin) {
  require $basePath . '/Routes/admin.php';
} else {
  require $basePath . '/Routes/web.php';
}
