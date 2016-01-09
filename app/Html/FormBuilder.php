<?php


namespace App\Html;

use App\Exceptions\FormBuilderException;
use App\Html\Rendering\AttributeRenderEngine as FrontendRenderEngine;
use Collective\Html\FormBuilder as CollectiveFormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Routing\UrlGenerator;
use MezzoLabs\Mezzo\Cockpit\Html\Rendering\FormBuilder as CockpitFormBuilder;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderEngine as AbstractRenderEngine;

class FormBuilder extends CollectiveFormBuilder
{


    /**
     * @var CockpitFormBuilder
     */
    protected $cockpitFormBuilder;

    /**
     * Create a new form builder instance.
     *
     * @param  \Illuminate\Contracts\Routing\UrlGenerator $url
     * @param  \Collective\Html\HtmlBuilder $html
     * @param  string $csrfToken
     *
     * @return void
     */
    public function __construct(HtmlBuilder $html, UrlGenerator $url, $csrfToken)
    {
        parent::__construct($html, $url, $csrfToken);

        $this->cockpitFormBuilder = app(CockpitFormBuilder::class);
    }


    public function attribute(string $name, array $options = [])
    {
        return $this->attributeRenderEngine()->render($this->getAttribute($name), $options);
    }

    public function validationAttributes(string $name)
    {
        $collection = $this->attributeRenderEngine()->validationAttributes($this->getAttribute($name));

        return $this->html->attributes($collection->toArray());
    }

    public function value($name)
    {
        return $this->getValueAttribute($name, null);
    }


    private function getAttribute(string $name) : Attribute
    {
        if (!$this->model) {
            throw new FormBuilderException('No model is set.');
        }

        $modelReflection = mezzo()->model(get_class($this->model));

        if (!$modelReflection->attributes()->has($name)) {
            throw new FormBuilderException("The model doesn't have an attribute called \"" . $name . "\".");
        }

        return $modelReflection->attributes($name);
    }

    /**
     * @return FrontendRenderEngine
     */
    private function attributeRenderEngine() : AbstractRenderEngine
    {
        return app(FrontendRenderEngine::class);
    }

    /**
     * Set the model instance on the form builder.
     *
     * @param  mixed $model
     *
     * @return void
     */
    public function setModel($model)
    {
        $this->cockpitFormBuilder->setModel($model);
        parent::setModel($model);
    }

    /**
     * Create a new model based form builder.
     *
     * @param  mixed $model
     * @param  array $options
     *
     * @return string
     */
    public function model($model, array $options = [])
    {
        $this->setModel($model);
        return parent::model($model, $options);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function hasModel()
    {
        return !empty($this->model);
    }

    /**
     * Open up a new HTML form.
     *
     * @param  array $options
     *
     * @return string
     */
    public function open(array $options = [])
    {
        if (isset($options['model']) && $options['model'])
            $this->setModel($options['model']);

        return parent::open($options); // TODO: Change the autogenerated stub
    }

    public function create(string $modelClass, array $options = [])
    {
        return $this->model(new $modelClass(), $options);
    }
}