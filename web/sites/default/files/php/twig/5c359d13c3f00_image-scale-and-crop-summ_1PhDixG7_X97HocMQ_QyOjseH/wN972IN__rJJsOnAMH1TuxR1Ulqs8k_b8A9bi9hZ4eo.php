<?php

/* core/themes/stable/templates/admin/image-scale-and-crop-summary.html.twig */
class __TwigTemplate_7b2e7d128ecb0ceb0e9abfeec55c8fd80df7d8bf1466ef86f69f495cc099015b extends Twig_Template
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
        $tags = array("if" => 18, "trans" => 22);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('if', 'trans'),
                array(),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 18
        if (($this->getAttribute(($context["data"] ?? null), "width", array()) && $this->getAttribute(($context["data"] ?? null), "height", array()))) {
            // line 19
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["data"] ?? null), "width", array()), "html", null, true));
            echo "×";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["data"] ?? null), "height", array()), "html", null, true));
        } else {
            // line 21
            if ($this->getAttribute(($context["data"] ?? null), "width", array())) {
                // line 22
                echo "    ";
                echo t("width @data.width", array("@data.width" => $this->getAttribute(                // line 23
($context["data"] ?? null), "width", array()), ));
                // line 25
                echo "  ";
            } elseif ($this->getAttribute(($context["data"] ?? null), "height", array())) {
                // line 26
                echo "    ";
                echo t("height @data.height", array("@data.height" => $this->getAttribute(                // line 27
($context["data"] ?? null), "height", array()), ));
                // line 29
                echo "  ";
            }
        }
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/image-scale-and-crop-summary.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 29,  61 => 27,  59 => 26,  56 => 25,  54 => 23,  52 => 22,  50 => 21,  45 => 19,  43 => 18,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "core/themes/stable/templates/admin/image-scale-and-crop-summary.html.twig", "/var/www/html/d8_composer/web/core/themes/stable/templates/admin/image-scale-and-crop-summary.html.twig");
    }
}
