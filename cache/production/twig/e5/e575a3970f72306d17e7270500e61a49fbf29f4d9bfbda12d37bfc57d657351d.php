<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* options.html */
class __TwigTemplate_ae5f588579956a504d3f2eb2b5aff1fcb2dcaa2b988f11d9750f6193987e7a41 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!--

";
        // line 3
        $value = "no";
        $context['definition']->set('SIDEBAR', $value);
        echo " Options: Yes | No
";
        // line 4
        $value = "yes";
        $context['definition']->set('HEADSEARCH', $value);
        echo " Options: Yes | No
-->";
    }

    public function getTemplateName()
    {
        return "options.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "options.html", "");
    }
}
