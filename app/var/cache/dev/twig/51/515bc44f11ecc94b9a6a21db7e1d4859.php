<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* main_page/index.html.twig */
class __TwigTemplate_8a4e2c5bfc074fc4ef57d698cb68b773 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "main_page/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "main_page/index.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "My cool models
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 7
        yield "\t<style>
\t\t.content {
\t\t\tmax-width: 900px;
\t\t\tmargin: 3rem auto;
\t\t\tpadding: 0 1rem;
\t\t\tline-height: 1.7;
\t\t\ttext-align: center;
\t\t}

\t\t.features {
\t\t\tdisplay: grid;
\t\t\tgrid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
\t\t\tgap: 2rem;
\t\t\tmargin-top: 2rem;
\t\t}

\t\t.feature {
\t\t\tbackground: white;
\t\t\tborder-radius: 0.75rem;
\t\t\tpadding: 1.5rem;
\t\t\tbox-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
\t\t\ttransition: transform 0.2s, box-shadow 0.2s;
\t\t}

\t\t.feature:hover {
\t\t\ttransform: translateY(-3px);
\t\t\tbox-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
\t\t}

\t\t.feature h3 {
\t\t\tcolor: #111827;
\t\t\tfont-size: 1.25rem;
\t\t\tmargin-bottom: 0.5rem;
\t\t}

\t\t.feature p {
\t\t\tcolor: #6b7280;
\t\t\tfont-size: 0.95rem;
\t\t}

\t\tfooter {
\t\t\ttext-align: center;
\t\t\tpadding: 2rem;
\t\t\tcolor: #6b7280;
\t\t\tfont-size: 0.9rem;
\t\t\tbackground-color: #f3f4f6;
\t\t\tmargin-top: 3rem;
\t\t}
\t</style>

\t<section class=\"content\">
\t\t<h2>Welcome to My cool models</h2>
\t\t<p>This is kind of a work in progress thing right now and there are supposed to be some cool visualizations of models or something here but not yet so just look around and imagine them maybe. However this page is still cool imo...
\t\t</p>

\t\t<div class=\"features\">
\t\t\t<div class=\"feature\">
\t\t\t\t<h3>🧠 Neural Networks</h3>
\t\t\t\t<p>Layers, neurons, connections ... all the things you might expect or maybe not. We'll see what I manage to do...</p>
\t\t\t</div>
\t\t\t<div class=\"feature\">
\t\t\t\t<h3>🔥 Pytorch Code</h3>
\t\t\t\t<p>See different AI architectures and their associated pytorch code. This surely isn't that hard to implement. The only hard thing is syntax highlight.</p>
\t\t\t</div>
\t\t\t<div class=\"feature\">
\t\t\t\t<h3>📊 Model Insights</h3>
\t\t\t\t<p>Charts, graphs, and diagrams that probably mean something important someday. I hope I will be able to add a framework that vizualises torch nn...</p>
\t\t\t</div>

\t\t</div>
\t</section>

\t<footer>
\t\t<p>©
\t\t\t";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield "
\t\t\tMy cool models — yeah I do have cool models indeed.</p>
\t</footer>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "main_page/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  177 => 81,  101 => 7,  88 => 6,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}My cool models
{% endblock %}

{% block body %}
\t<style>
\t\t.content {
\t\t\tmax-width: 900px;
\t\t\tmargin: 3rem auto;
\t\t\tpadding: 0 1rem;
\t\t\tline-height: 1.7;
\t\t\ttext-align: center;
\t\t}

\t\t.features {
\t\t\tdisplay: grid;
\t\t\tgrid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
\t\t\tgap: 2rem;
\t\t\tmargin-top: 2rem;
\t\t}

\t\t.feature {
\t\t\tbackground: white;
\t\t\tborder-radius: 0.75rem;
\t\t\tpadding: 1.5rem;
\t\t\tbox-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
\t\t\ttransition: transform 0.2s, box-shadow 0.2s;
\t\t}

\t\t.feature:hover {
\t\t\ttransform: translateY(-3px);
\t\t\tbox-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
\t\t}

\t\t.feature h3 {
\t\t\tcolor: #111827;
\t\t\tfont-size: 1.25rem;
\t\t\tmargin-bottom: 0.5rem;
\t\t}

\t\t.feature p {
\t\t\tcolor: #6b7280;
\t\t\tfont-size: 0.95rem;
\t\t}

\t\tfooter {
\t\t\ttext-align: center;
\t\t\tpadding: 2rem;
\t\t\tcolor: #6b7280;
\t\t\tfont-size: 0.9rem;
\t\t\tbackground-color: #f3f4f6;
\t\t\tmargin-top: 3rem;
\t\t}
\t</style>

\t<section class=\"content\">
\t\t<h2>Welcome to My cool models</h2>
\t\t<p>This is kind of a work in progress thing right now and there are supposed to be some cool visualizations of models or something here but not yet so just look around and imagine them maybe. However this page is still cool imo...
\t\t</p>

\t\t<div class=\"features\">
\t\t\t<div class=\"feature\">
\t\t\t\t<h3>🧠 Neural Networks</h3>
\t\t\t\t<p>Layers, neurons, connections ... all the things you might expect or maybe not. We'll see what I manage to do...</p>
\t\t\t</div>
\t\t\t<div class=\"feature\">
\t\t\t\t<h3>🔥 Pytorch Code</h3>
\t\t\t\t<p>See different AI architectures and their associated pytorch code. This surely isn't that hard to implement. The only hard thing is syntax highlight.</p>
\t\t\t</div>
\t\t\t<div class=\"feature\">
\t\t\t\t<h3>📊 Model Insights</h3>
\t\t\t\t<p>Charts, graphs, and diagrams that probably mean something important someday. I hope I will be able to add a framework that vizualises torch nn...</p>
\t\t\t</div>

\t\t</div>
\t</section>

\t<footer>
\t\t<p>©
\t\t\t{{ \"now\"|date(\"Y\") }}
\t\t\tMy cool models — yeah I do have cool models indeed.</p>
\t</footer>
{% endblock %}
", "main_page/index.html.twig", "/home/idiams/TSP/CSC4101_php/model_sharing_webapp/my_cool_models/templates/main_page/index.html.twig");
    }
}
