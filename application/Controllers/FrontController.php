<?php

namespace App\Controllers;

use BadMethodCallException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \FrontControllerCore as MainController;
use Symfony\Component\Debug\Debug;
use App\Classes\Factory;

class FrontController extends MainController
{
    public $context;

    public $factory;

    public $application;

    public $app_page_title = 'PrestoLara';

    public $app_page;

    public $app_page_description = 'Page description';

    public $app_page_keywords = 'itinnovator, jigesh raval';

    public $css = array();

    public $js = array();

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

    public function __construct()
    {
        parent::__construct();
        $this->factory = Factory::getFactory();
        $this->page();
        Debug::enable();
        if (!$this->context->cart) {
          $this->context->cart = new \Cart($this->context->cookie->id_cart);
        }
        header('Cache-Control: no-cache');
    }

    protected function assignGeneralPurposeVariables()
    {
        $templateVars = array(
            'currency' => $this->getTemplateVarCurrency(),
            'customer' => $this->getTemplateVarCustomer(),
            'language' => $this->objectPresenter->present($this->context->language),
            'page' => $this->getTemplateVarPage(),
            'shop' => $this->getTemplateVarShop(),
            'urls' => $this->getTemplateVarUrls(),
            'configuration' => $this->getTemplateVarConfiguration(),
            'field_required' => $this->context->customer->validateFieldsRequiredDatabase(),
            'breadcrumb' => $this->getBreadcrumb(),
            'link' => $this->context->link,
            'time' => time(),
            'static_token' => \Tools::getToken(false),
            'token' => \Tools::getToken(),
            'user_logged' => $this->context->customer->isLogged(),
            'user_fullname' => $this->context->customer->firstname . ' ' . $this->context->customer->lastname,
            'user_obj' => $this->context->customer,
            'isMobile' => $this->context->isMobile(),
            'isTablet' => $this->context->isTablet(),
            'js' => $this->js,
            'css' => $this->css
        );

        $this->context->smarty->assign($templateVars);
        \Media::addJsDef(array('prestashop' => $templateVars));
    }

    public function getUrls()
    {
        return $this->getTemplateVarUrls();
    }

    public function pre($array)
  	{
    		echo '<pre>';
    		print_r($array);
    		echo '</pre>';
    		echo '<hr>';
  	}

    /**
     * Sets controller CSS and JS files.
     *
     * @return bool
     */
    public function setMedia()
    {
        $this->registerStylesheet('theme-main', '/assets/css/theme.css', ['media' => 'all', 'priority' => 50]);
        $this->registerStylesheet('theme-custom', '/assets/css/custom.css', ['media' => 'all', 'priority' => 1000]);

        if ($this->context->language->is_rtl) {
            $this->registerStylesheet('theme-rtl', '/assets/css/rtl.css', ['media' => 'all', 'priority' => 900]);
        }

        $this->registerJavascript('corejs', '/themes/core.js', ['position' => 'bottom', 'priority' => 0]);
        $this->registerJavascript('theme-main', '/assets/js/theme.js', ['position' => 'bottom', 'priority' => 50]);
        $this->registerJavascript('theme-custom', '/assets/js/custom.js', ['position' => 'bottom', 'priority' => 1000]);

        $assets = $this->context->shop->theme->getPageSpecificAssets($this->php_self);
        if (!empty($assets)) {
            foreach ($assets['css'] as $css) {
                $this->registerStylesheet($css['id'], $css['path'], $css);
            }
            foreach ($assets['js'] as $js) {
                $this->registerJavascript($js['id'], $js['path'], $js);
            }
        }

        // Execute Hook FrontController SetMedia
        \Hook::exec('actionFrontControllerSetMedia', array());

        return true;
    }

    public function init()
    {
        parent::init();
        $this->initReferral();
    }

    public function initHeader()
    {
        /* @see P3P Policies (http://www.w3.org/TR/2002/REC-P3P-20020416/#compact_policies) */
        header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
        header('Using: PrestoLara');
    }

    public function template($template)
    {
        $this->setMedia();
        parent::init();
        $this->assignGeneralPurposeVariables();
        $this->process();

        if (!isset($this->context->cart)) {
            $this->context->cart = new \Cart();
        }
        $this->context->smarty->assign([
          'text' => "Jigesh"
        ]);

        $this->context->smarty->assign(array(
            'js' => $this->js,
            'css' => $this->css,
            'HOOK_HEADER' => \Hook::exec('displayHeader')
        ));

        $this->context->smarty->assign(array(
            'layout' => $this->getLayout(),
            'stylesheets' => $this->getStylesheets(),
            'javascript' => $this->getJavascript(),
            'js_custom_vars' => \Media::getJsDef(),
            'notifications' => $this->prepareNotifications(),
            'title' => $this->app_page_title
        ));
        $this->setTemplate($template);
        $this->display();
    }

    public function test()
    {
        return $this->template('test');
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

    public function getPageName()
    {
        if (!isset($this->app_page_title)) {
          return parent::getPageName();
        }
        return str_slug($this->app_page_title);
    }

    public function page()
    {
        if ($this->app_page_title) {
          $meta = $this->factory->meta;
          $page = $meta->fetch('page', str_slug($this->app_page_title));

          if (isset($page->id_meta) && $page->id_meta) {
            return $this->page = $this->factory->meta_lang->find($page->id_meta);
          }

          $new_meta = $meta->fill([
            'page' => str_slug($this->app_page_title),
            'configurable' => 1
          ]);
          $new_meta->save();

          $page = $this->factory->meta_lang->fill([
            'id_meta' => $new_meta->page,
            'id_shop' => $this->context->shop->id,
            'id_lang' => $this->context->cookie->id_lang,
            'title' => $this->app_page_title,
            'description' => $this->app_page_description,
            'keywords' => $this->app_page_keywords,
            'url_rewrite' => '',
          ]);
          $page->save();

          return $this->page = $page;
        }
    }

    public function getTemplateVarPage()
    {
        $page_name = $this->getPageName();
        $meta_tags = \Meta::getMetaTags($this->context->language->id, $page_name);

        $my_account_controllers = array(
            'address',
            'authentication',
            'discount',
            'history',
            'identity',
            'order-follow',
            'order-slip',
            'password',
            'guest-tracking',
        );

        $body_classes = array(
            'lang-'.$this->context->language->iso_code => true,
            'lang-rtl' => (bool) $this->context->language->is_rtl,
            'country-'.$this->context->country->iso_code => true,
            // 'currency-'.$this->context->currency->iso_code => true,
            $this->context->shop->theme->getLayoutNameForPage($this->php_self) => true,
            'page-'.$this->php_self => true,
            'tax-display-'.($this->getDisplayTaxesLabel() ? 'enabled' : 'disabled') => true,
        );

        if (in_array($this->php_self, $my_account_controllers)) {
            $body_classes['page-customer-account'] = true;
        }

        $page = array(
            'title' => '',
            'canonical' => $this->getCanonicalURL(),
            'meta' => array(
                'title' => $meta_tags['meta_title'],
                'description' => $meta_tags['meta_description'],
                'keywords' => $meta_tags['meta_keywords'],
                'robots' => 'index',
            ),
            'page_name' => $page_name,
            'body_classes' => $body_classes,
            'admin_notifications' => array(),
        );

        return $page;
    }

    public function initReferral()
    {
        if (!\Tools::getValue('ref')) {
          return;
        }

        $ref = \Tools::getValue('ref');
        $sponsor = $this->factory->affiliate->find($ref);
        if ($sponsor->id_customer) {
          $this->factory->session->set('sponsor', $ref);
        }
    }
}
