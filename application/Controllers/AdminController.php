<?php

namespace App\Controllers;

use BadMethodCallException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \AdminController as BaseController;

class AdminController extends BaseController
{
    public $context;

    public $application;
    /**
     * The middleware registered on the controller.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * The router instance.
     *
     * @var \Illuminate\Routing\Router
     */
    protected static $router;

    public $factory;

    public $toolbar = array();

    public $page_title = 'Application Page';

    public function __construct()
    {
        parent::__construct();
        $this->view = 'view';
        $this->context = \Context::getContext();
        $this->display = 'view';
        $this->factory = \App\Classes\Factory::getFactory();
        $this->context->smarty->assign([
          'factory' => $this->factory
        ]);
    }

    /**
     * Register middleware on the controller.
     *
     * @param  array|string  $middleware
     * @param  array   $options
     * @return \Illuminate\Routing\ControllerMiddlewareOptions
     */
    public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $middlewareName) {
            $this->middleware[$middlewareName] = &$options;
        }

        return new ControllerMiddlewareOptions($options);
    }

    /**
     * Get the middleware assigned to the controller.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Get the router instance.
     *
     * @return \Illuminate\Routing\Router
     */
    public static function getRouter()
    {
        return static::$router;
    }

    /**
     * Set the router instance.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public static function setRouter(Router $router)
    {
        static::$router = $router;
    }

    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  array   $parameters
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function missingMethod($parameters = [])
    {
        throw new NotFoundHttpException('Controller method not found.');
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException("Method [$method] does not exist.");
    }

    public function template($view)
    {
        if (!$view) {
          return;
        }

        $this->bootstrap = true;
        if (!$this->meta_title) {
          $this->meta_title = 'IT-Innovator Custom App!';
        }

        $this->context->smarty->assign([
          'adminURL' => AdminURL(),
          'adminToken' => \Tools::getAdminToken('AdminCustomers'.(int)(\Tab::getIdFromClassName('AdminCustomers')).(int)($this->context->cookie->id_employee)),
          'new_toolbar' => $this->toolbar,
          'page_title' => $this->page_title
        ]);

        $this->setMedia();
        $this->initHeader();
        $this->init();
        $this->initFooter();
        $this->layout = _PS_ROOT_DIR_ . '/application/themes/admin/' . $view;
        $this->display();
    }

    public function test()
    {
        $this->template('view.tpl');
    }

    public function renderView()
    {
        return 'Test Thanks!';
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS('//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/css/jquery.dataTables.min.css');
        $this->addCSS('//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.css');
        $this->addCSS('//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css');
        $this->addCSS('//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.css');

        $this->addJS('//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/js/jquery.dataTables.min.js');
        $this->addJS('//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js');
        $this->addJS('//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js');
        $this->addJS('//maps.google.com/maps/api/js?libraries=places&key=AIzaSyBr93dbi4Xdk7zBFrCq_Nowo8QZ6cRXXro');
        $this->addJS(AdminJSURL().'core.js');
    }
}
