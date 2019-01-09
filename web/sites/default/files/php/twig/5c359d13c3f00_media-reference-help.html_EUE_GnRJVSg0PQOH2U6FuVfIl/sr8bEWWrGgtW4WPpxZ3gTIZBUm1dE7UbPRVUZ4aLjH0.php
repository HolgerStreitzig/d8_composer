<?php

/* core/themes/stable/templates/content/media-reference-help.html.twig */
class __TwigTemplate_be479fafa677f85b3ba4ffbfe6f3c11ccdbad6d9178bf5aaf76730b917bf977f extends Twig_Template
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
        $tags = array("set" => 11, "if" => 32, "trans" => 34, "for" => 46);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('set', 'if', 'trans', 'for'),
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

        // line 11
        $context["classes"] = array(0 => "js-form-item", 1 => "form-item", 2 => "js-form-wrapper", 3 => "form-wrapper");
        // line 18
        echo "<fieldset";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["attributes"] ?? null), "addClass", array(0 => ($context["classes"] ?? null)), "method"), "html", null, true));
        echo ">
  ";
        // line 20
        $context["legend_span_classes"] = array(0 => "fieldset-legend", 1 => ((        // line 22
($context["required"] ?? null)) ? ("js-form-required") : ("")), 2 => ((        // line 23
($context["required"] ?? null)) ? ("form-required") : ("")));
        // line 26
        echo "  ";
        // line 27
        echo "  <legend";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["legend_attributes"] ?? null), "html", null, true));
        echo ">
    <span";
        // line 28
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["legend_span_attributes"] ?? null), "addClass", array(0 => ($context["legend_span_classes"] ?? null)), "method"), "html", null, true));
        echo ">";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["original_label"] ?? null), "html", null, true));
        echo "</span>
  </legend>

  <div class=\"js-form-item form-item\">
    ";
        // line 32
        if (($context["media_add_help"] ?? null)) {
            // line 33
            echo "      <h4";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["header_attributes"] ?? null), "addClass", array(0 => "label"), "method"), "html", null, true));
            echo ">
        ";
            // line 34
            echo t("Create new media", array());
            // line 37
            echo "      </h4><br />
      <div class=\"description\">
        ";
            // line 39
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["media_add_help"] ?? null), "html", null, true));
            echo "
      </div>
    ";
        }
        // line 42
        echo "
    ";
        // line 43
        if (($context["multiple"] ?? null)) {
            // line 44
            echo "      ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["table"] ?? null), "html", null, true));
            echo "
    ";
        } else {
            // line 46
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["elements"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 47
                echo "        ";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $context["element"], "html", null, true));
                echo "
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "    ";
        }
        // line 50
        echo "
    <div";
        // line 51
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($this->getAttribute(($context["description"] ?? null), "attributes", array()), "addClass", array(0 => "description"), "method"), "html", null, true));
        echo ">
      ";
        // line 52
        if ((($context["multiple"] ?? null) && $this->getAttribute(($context["description"] ?? null), "content", array()))) {
            // line 53
            echo "        <ul>
          <li>";
            // line 54
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["media_list_help"] ?? null), "html", null, true));
            echo " ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["media_list_link"] ?? null), "html", null, true));
            echo " ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["allowed_types_help"] ?? null), "html", null, true));
            echo "</li>
          <li>";
            // line 55
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["description"] ?? null), "content", array()), "html", null, true));
            echo "</li>
        </ul>
      ";
        } else {
            // line 58
            echo "        ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["media_list_help"] ?? null), "html", null, true));
            echo " ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["media_list_link"] ?? null), "html", null, true));
            echo " ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["allowed_types_help"] ?? null), "html", null, true));
            echo "
      ";
        }
        // line 60
        echo "      ";
        if ((($context["multiple"] ?? null) && ($context["button"] ?? null))) {
            // line 61
            echo "        <div class=\"clearfix\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["button"] ?? null), "html", null, true));
            echo "</div>
      ";
        }
        // line 63
        echo "    </div>

  </div>
</fieldset>
";
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/content/media-reference-help.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 63,  156 => 61,  153 => 60,  143 => 58,  137 => 55,  129 => 54,  126 => 53,  124 => 52,  120 => 51,  117 => 50,  114 => 49,  105 => 47,  100 => 46,  94 => 44,  92 => 43,  89 => 42,  83 => 39,  79 => 37,  77 => 34,  72 => 33,  70 => 32,  61 => 28,  56 => 27,  54 => 26,  52 => 23,  51 => 22,  50 => 20,  45 => 18,  43 => 11,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "core/themes/stable/templates/content/media-reference-help.html.twig", "/var/www/html/d8_composer/web/core/themes/stable/templates/content/media-reference-help.html.twig");
    }
}
