<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_454b61d1db297eb60057789f9f76ca4c5aee6d3349f8e4921a6eb6f06ab41977 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_0ae83465daa1b4b540258422b95797c132ae2fd5e650e66413d0f936833a3875 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_0ae83465daa1b4b540258422b95797c132ae2fd5e650e66413d0f936833a3875->enter($__internal_0ae83465daa1b4b540258422b95797c132ae2fd5e650e66413d0f936833a3875_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_0ae83465daa1b4b540258422b95797c132ae2fd5e650e66413d0f936833a3875->leave($__internal_0ae83465daa1b4b540258422b95797c132ae2fd5e650e66413d0f936833a3875_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_13c6a8859fcd8bdecfad0e547f6e000957f6ca057d08e957f3cb86d30fb79b92 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_13c6a8859fcd8bdecfad0e547f6e000957f6ca057d08e957f3cb86d30fb79b92->enter($__internal_13c6a8859fcd8bdecfad0e547f6e000957f6ca057d08e957f3cb86d30fb79b92_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_13c6a8859fcd8bdecfad0e547f6e000957f6ca057d08e957f3cb86d30fb79b92->leave($__internal_13c6a8859fcd8bdecfad0e547f6e000957f6ca057d08e957f3cb86d30fb79b92_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_2142733f5a71245981d8f2199d5e175b9d8182b27adb2e3a3a906014544f7ff2 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_2142733f5a71245981d8f2199d5e175b9d8182b27adb2e3a3a906014544f7ff2->enter($__internal_2142733f5a71245981d8f2199d5e175b9d8182b27adb2e3a3a906014544f7ff2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_2142733f5a71245981d8f2199d5e175b9d8182b27adb2e3a3a906014544f7ff2->leave($__internal_2142733f5a71245981d8f2199d5e175b9d8182b27adb2e3a3a906014544f7ff2_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_6645e9652c45d78b72c0534e830475e5552f5da88273188898b9f75c26812896 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_6645e9652c45d78b72c0534e830475e5552f5da88273188898b9f75c26812896->enter($__internal_6645e9652c45d78b72c0534e830475e5552f5da88273188898b9f75c26812896_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpKernelExtension')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("_profiler_router", array("token" => ($context["token"] ?? $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_6645e9652c45d78b72c0534e830475e5552f5da88273188898b9f75c26812896->leave($__internal_6645e9652c45d78b72c0534e830475e5552f5da88273188898b9f75c26812896_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
", "@WebProfiler/Collector/router.html.twig", "/home/myjigeshraval/public_html/presta.jigeshraval.com/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views/Collector/router.html.twig");
    }
}
