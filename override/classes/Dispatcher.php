<?php
/**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

/**
 * @since 1.5.0
 */
class Dispatcher extends DispatcherCore
{
    public $app;

    public $request;

    public function dispatch()
    {
        $controller_class = '';

        // Get current controller
        $this->getController();
        if (!$this->controller || $this->controller == 'pagenotfound') {
          $request = Illuminate\Http\Request::createFromGlobals();
          $this->app['request'] = $request;
          $response = $this->app['router']->dispatch($request);
          return $response->send();
        }

        // Execute hook dispatcher before
        Hook::exec('actionDispatcherBefore', array ('controller_type' => $this->front_controller));

        // Dispatch with right front controller
        switch ($this->front_controller) {
            // Dispatch front office controller
            case self::FC_FRONT :
                $controllers = Dispatcher::getControllers(array(_PS_FRONT_CONTROLLER_DIR_, _PS_OVERRIDE_DIR_.'controllers/front/'));
                $controllers['index'] = 'IndexController';
                if (isset($controllers['auth'])) {
                    $controllers['authentication'] = $controllers['auth'];
                }
                if (isset($controllers['contact'])) {
                    $controllers['contactform'] = $controllers['contact'];
                }

                if (!isset($controllers[strtolower($this->controller)])) {
                    $this->controller = $this->controller_not_found;
                }
                $controller_class = $controllers[strtolower($this->controller)];
                $params_hook_action_dispatcher = array('controller_type' => self::FC_FRONT, 'controller_class' => $controller_class, 'is_module' => 0);
            break;

            // Dispatch module controller for front office
            case self::FC_MODULE :
                $module_name = Validate::isModuleName(Tools::getValue('module')) ? Tools::getValue('module') : '';
                $module = Module::getInstanceByName($module_name);
                $controller_class = 'PageNotFoundController';
                if (Validate::isLoadedObject($module) && $module->active) {
                    $controllers = Dispatcher::getControllers(_PS_MODULE_DIR_.$module_name.'/controllers/front/');
                    if (isset($controllers[strtolower($this->controller)])) {
                        include_once(_PS_MODULE_DIR_.$module_name.'/controllers/front/'.$this->controller.'.php');
                        if (file_exists(_PS_OVERRIDE_DIR_ . 'modules/' . $module_name . '/controllers/front/' . $this->controller . '.php')) {
                            include_once(_PS_OVERRIDE_DIR_ . 'modules/' . $module_name . '/controllers/front/' . $this->controller . '.php');
                            $controller_class = $module_name . $this->controller . 'ModuleFrontControllerOverride';
                        } else {
                            $controller_class = $module_name . $this->controller . 'ModuleFrontController';
                        }
                    }
                }
                $params_hook_action_dispatcher = array('controller_type' => self::FC_FRONT, 'controller_class' => $controller_class, 'is_module' => 1);
            break;

            // Dispatch back office controller + module back office controller
            case self::FC_ADMIN :
                if ($this->use_default_controller && !Tools::getValue('token') && Validate::isLoadedObject(Context::getContext()->employee) && Context::getContext()->employee->isLoggedBack()) {
                    Tools::redirectAdmin('index.php?controller='.$this->controller.'&token='.Tools::getAdminTokenLite($this->controller));
                }

                $tab = Tab::getInstanceFromClassName($this->controller, Configuration::get('PS_LANG_DEFAULT'));
                $retrocompatibility_admin_tab = null;

                if ($tab->module) {
                    if (file_exists(_PS_MODULE_DIR_.$tab->module.'/'.$tab->class_name.'.php')) {
                        $retrocompatibility_admin_tab = _PS_MODULE_DIR_.$tab->module.'/'.$tab->class_name.'.php';
                    } else {
                        $controllers = Dispatcher::getControllers(_PS_MODULE_DIR_.$tab->module.'/controllers/admin/');
                        if (!isset($controllers[strtolower($this->controller)])) {
                            $this->controller = $this->controller_not_found;
                            $controller_class = 'AdminNotFoundController';
                        } else {
                            // Controllers in modules can be named AdminXXX.php or AdminXXXController.php
                            include_once(_PS_MODULE_DIR_.$tab->module.'/controllers/admin/'.$controllers[strtolower($this->controller)].'.php');
                            if (file_exists(_PS_OVERRIDE_DIR_ . 'modules/' . $tab->module . '/controllers/admin/' . $controllers[strtolower($this->controller)] . '.php')) {
                                include_once(_PS_OVERRIDE_DIR_ . 'modules/' . $tab->module . '/controllers/admin/' . $controllers[strtolower($this->controller)] . '.php');
                                $controller_class = $controllers[strtolower($this->controller)] . (strpos($controllers[strtolower($this->controller)], 'Controller') ? 'Override' : 'ControllerOverride');
                            } else {
                                $controller_class = $controllers[strtolower($this->controller)] . (strpos($controllers[strtolower($this->controller)], 'Controller') ? '' : 'Controller');
                            }
                        }
                    }
                    $params_hook_action_dispatcher = array('controller_type' => self::FC_ADMIN, 'controller_class' => $controller_class, 'is_module' => 1);
                } else {
                    $controllers = Dispatcher::getControllers(array(_PS_ADMIN_DIR_.'/tabs/', _PS_ADMIN_CONTROLLER_DIR_, _PS_OVERRIDE_DIR_.'controllers/admin/'));
                    if (!isset($controllers[strtolower($this->controller)])) {
                        // If this is a parent tab, load the first child
                        if (Validate::isLoadedObject($tab) && $tab->id_parent == 0 && ($tabs = Tab::getTabs(Context::getContext()->language->id, $tab->id)) && isset($tabs[0])) {
                            Tools::redirectAdmin(Context::getContext()->link->getAdminLink($tabs[0]['class_name']));
                        }
                        $this->controller = $this->controller_not_found;
                    }

                    $controller_class = $controllers[strtolower($this->controller)];
                    $params_hook_action_dispatcher = array('controller_type' => self::FC_ADMIN, 'controller_class' => $controller_class, 'is_module' => 0);

                    if (file_exists(_PS_ADMIN_DIR_.'/tabs/'.$controller_class.'.php')) {
                        $retrocompatibility_admin_tab = _PS_ADMIN_DIR_.'/tabs/'.$controller_class.'.php';
                    }
                }

                // @retrocompatibility with admin/tabs/ old system
                if ($retrocompatibility_admin_tab) {
                    include_once($retrocompatibility_admin_tab);
                    include_once(_PS_ADMIN_DIR_.'/functions.php');
                    runAdminTab($this->controller, !empty($_REQUEST['ajaxMode']));
                    return;
                }

            break;

            default :
                throw new PrestaShopException('Bad front controller chosen');
        }

        // Instantiate controller
        try {
            // Loading controller
            $controller = Controller::getController($controller_class);

            // Execute hook dispatcher
            if (isset($params_hook_action_dispatcher)) {
                Hook::exec('actionDispatcher', $params_hook_action_dispatcher);
            }

            // Running controller
            $controller->run();

            // Execute hook dispatcher after
            if (isset($params_hook_action_dispatcher)) {
                Hook::exec('actionDispatcherAfter', $params_hook_action_dispatcher);
            }
        } catch (PrestaShopException $e) {
            $e->displayMessage();
        }
    }
}
