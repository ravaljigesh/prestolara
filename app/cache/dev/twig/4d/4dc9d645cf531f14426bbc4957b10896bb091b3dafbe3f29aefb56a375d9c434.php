<?php

/* PrestaShopBundle:Admin/Module/Includes:card_grid_addons.html.twig */
class __TwigTemplate_46ed943723ffbb7ae142e613c0efc0b630a8cd94039315daae11273b682d3eec extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_d352ec64ae887813c55e823a9f8db29b2be80865c16990b973c186458ae97010 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d352ec64ae887813c55e823a9f8db29b2be80865c16990b973c186458ae97010->enter($__internal_d352ec64ae887813c55e823a9f8db29b2be80865c16990b973c186458ae97010_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "PrestaShopBundle:Admin/Module/Includes:card_grid_addons.html.twig"));

        // line 25
        echo "<div class=\"module-addons-item-grid col-md-12 col-lg-6 col-xl-3\">
    <div class=\"module-addons-item-wrapper-grid\">
      <span class=\"module-icon-addons-exit-grid\">
        <img src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("themes/default/img/preston.png"), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Exit to PrestaShop Addons Marketplace", array(), "Admin.Modules.Feature"), "html", null, true);
        echo "\" />
      </span>
      ";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("See all results for your search on", array(), "Admin.Modules.Feature"), "html", null, true);
        echo "<br/>
      <a class=\"url\" href=\"#\">";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("PrestaShop Addons Marketplace", array(), "Admin.Modules.Feature"), "html", null, true);
        echo "</a>
    </div>
</div>
";
        
        $__internal_d352ec64ae887813c55e823a9f8db29b2be80865c16990b973c186458ae97010->leave($__internal_d352ec64ae887813c55e823a9f8db29b2be80865c16990b973c186458ae97010_prof);

    }

    public function getTemplateName()
    {
        return "PrestaShopBundle:Admin/Module/Includes:card_grid_addons.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 31,  34 => 30,  27 => 28,  22 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#**
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
 *#}
<div class=\"module-addons-item-grid col-md-12 col-lg-6 col-xl-3\">
    <div class=\"module-addons-item-wrapper-grid\">
      <span class=\"module-icon-addons-exit-grid\">
        <img src=\"{{ asset('themes/default/img/preston.png') }}\" alt=\"{{ 'Exit to PrestaShop Addons Marketplace'|trans({}, 'Admin.Modules.Feature') }}\" />
      </span>
      {{ 'See all results for your search on'|trans({}, 'Admin.Modules.Feature') }}<br/>
      <a class=\"url\" href=\"#\">{{ 'PrestaShop Addons Marketplace'|trans({}, 'Admin.Modules.Feature') }}</a>
    </div>
</div>
", "PrestaShopBundle:Admin/Module/Includes:card_grid_addons.html.twig", "/home/myjigeshraval/public_html/presta.jigeshraval.com/src/PrestaShopBundle/Resources/views/Admin/Module/Includes/card_grid_addons.html.twig");
    }
}
