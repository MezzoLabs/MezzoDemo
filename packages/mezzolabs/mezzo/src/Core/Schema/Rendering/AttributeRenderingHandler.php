<?php


namespace MezzoLabs\Mezzo\Core\Schema\Rendering;


use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;

abstract class AttributeRenderingHandler
{
    /**
     * @var AttributeRenderer
     */
    protected $attributeRenderer;

    /**
     * @var Attribute
     */
    protected $attribute;

    /**
     * @param Attribute $attribute
     * @param AttributeRenderer $attributeRenderer
     */
    public function __construct(Attribute $attribute, AttributeRenderer $attributeRenderer)
    {
        $this->attributeRenderer = $attributeRenderer;
        $this->attribute = $attribute;
    }

    /**
     * Checks if this handler is responsible for rendering this kind of input.
     *
     * @param InputType $inputType
     * @return boolean
     */
    abstract public function handles(InputType $inputType);

    /**
     * Render the attribute to HTML.
     *
     * @return string
     */
    abstract public function render();

    /**
     * @return \Collective\Html\FormBuilder
     */
    public function formBuilder()
    {
        return $this->attributeRenderer->formBuilder();
    }

    /**
     * Create a list for a select box.
     *
     * @param bool $addPleaseSelect
     * @return array
     * @throws AttributeRenderingException
     */
    public function makeEloquentList($addPleaseSelect = true)
    {
        if (!$this->attribute() instanceof RelationAttribute)
            throw new AttributeRenderingException('Cannot get a list for a non relation attribute.');

        $collection = $this->attribute()->query()->get();

        $array = $collection->pluck('label', 'id')->toArray();

        if (!$addPleaseSelect)
            return $array;

        $array[null] = 'Please Select';

        return $array;
    }

    /**
     * @return Attribute
     */
    public function attribute()
    {
        return $this->attribute;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->attribute()->name();
    }

    public function old()
    {
        return old($this->name());
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function htmlAttributes()
    {
        return $this->attributeRenderer->htmlAttributes($this->attribute());
    }


}