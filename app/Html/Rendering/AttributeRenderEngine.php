<?php


namespace App\Html\Rendering;

use Collective\Html\FormBuilder;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Cockpit\Html\Rendering\AttributeRenderEngine as CockpitRenderEngine;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderEngine as AbstractRenderEngine;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingException;
use MezzoLabs\Mezzo\Core\Schema\Rendering\AttributeRenderingHandler;

class AttributeRenderEngine extends AbstractRenderEngine
{
    protected $cssClass = '';

    public static $handlers = [

    ];

    /**
     * @var CockpitRenderEngine
     */
    protected $cockpitRenderEngine;

    public function __construct(CockpitRenderEngine $cockpitRenderEngine)
    {
        $this->cockpitRenderEngine = $cockpitRenderEngine;
        static::$handlers = array_merge(CockpitRenderEngine::$handlers);
    }

    /**
     * Generate the HTML for the attribute schema.
     *
     * @param Attribute $attribute
     * @param array $options
     * @return string
     * @throws AttributeRenderingException
     */
    public function render(Attribute $attribute, array $options = []) :  string
    {
        return parent::render($attribute, $options); // TODO: Change the autogenerated stub
    }


    /**
     * @return FormBuilder
     */
    public function formBuilder()
    {
        return app('magazine_form');
    }

    /**
     * Create an array of html attributes for this attribute schema.
     *
     * @param Attribute $attribute
     * @return Collection
     */
    public function htmlAttributes(Attribute $attribute)
    {
        $htmlAttributes = new Collection();

        $htmlAttributes = $htmlAttributes->merge($attribute->type()->htmlAttributes());
        $htmlAttributes = $htmlAttributes->merge($this->validationAttributes($attribute));

        return $htmlAttributes->toArray();

    }

    public function validationAttributes(Attribute $attribute)
    {
        return $this->cockpitRenderEngine->validationAttributes($attribute);
    }

    public function defaultAfter(AttributeRenderingHandler $handler)
    {
        return "<small>" . $handler->getErrorString() . "</small>";
    }


}