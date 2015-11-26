<?php


namespace MezzoLabs\Mezzo\Core\Schema\Rendering;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use MezzoLabs\Mezzo\Core\Helpers\StringHelper;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;

abstract class AttributeRenderingHandler
{
    /**
     * @var AttributeRenderEngine
     */
    protected $attributeRenderer;

    /**
     * @var Attribute
     */
    protected $attribute;

    /**
     * @var AttributeRenderingOptions
     */
    protected $options;

    /**
     * @param Attribute $attribute
     * @param AttributeRenderEngine $attributeRenderer
     */
    public function __construct(Attribute $attribute, AttributeRenderEngine $attributeRenderer)
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
     * @return Attribute|RelationAttribute
     */
    public function attribute()
    {
        return $this->attribute;
    }

    public function relationSide()
    {
        if (!$this->attribute()->isRelationAttribute())
            throw new AttributeRenderingException('Cannot get the relation side of an atomic attribute: "' . $this->name() . '""');

        return $this->attribute()->relationSide();
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\ModelSchema
     */
    public function model()
    {
        return $this->attribute()->getModel();
    }

    /**
     * @return string
     */
    public function name()
    {
        if (!$this->getOptions()->isNested())
            return $this->attribute()->name();

        if ($this->getOptions()->parent()->relationSide()->hasOneChild())
            return $this->getOptions()->parentName() . '[' . $this->attribute()->name() . ']';

        return $this->getOptions()->parentName() . '[0][' . $this->attribute()->name() . ']';
    }

    public function value()
    {
        if ($this->getOptions()->hasAttribute('value'))
            return $this->getOptions()->getAttribute('value');

        return $this->old();
    }

    public function old()
    {
        return old(StringHelper::fromArrayToDotNotation($this->name()));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function htmlAttributes()
    {
        $htmlAttributes = $this->attributeRenderer->htmlAttributes($this->attribute());
        return array_merge($htmlAttributes, $this->getOptions()->attributes());
    }

    /**
     * @return AttributeRenderingOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = new AttributeRenderingOptions(new Collection($options));
    }

    /**
     * Get the string of a element that is nested in this form
     *
     * @param string $nestedAttributeName
     * @param array $attributes
     * @return mixed
     * @throws AttributeRenderingException
     * @throws \MezzoLabs\Mezzo\Exceptions\ReflectionException
     */
    public function renderNested($nestedAttributeName, array $attributes = [])
    {
        $options = [
            'parent' => $this,
            'attributes' => $attributes
        ];

        $nestedModel = $this->relationSide()->otherModelReflection()->schema();

        if (!$nestedModel->hasAttribute($nestedAttributeName))
            return "!! NESTED ATTRIBUTE NOT FOUND";

        $nestedAttribute = $nestedModel->attributes($nestedAttributeName);

        return mezzo()->attribute($nestedModel->className(), $nestedAttribute->name())->render($options);
    }

    public function before()
    {
        return '<div class="' . $this->formGroupClass() . '"><label>' . $this->attribute()->title() . '</label>';
    }

    protected function formGroupClass()
    {
        $class = 'form-group';

        if ($this->hasError())
            $class .= ' has-error';

        return $class;
    }

    public function after()
    {
        return '</div>';
    }

    protected function hasError()
    {
        $name = StringHelper::fromArrayToDotNotation($this->name());

        if (!Session::has('errors'))
            return false;

        return Session::get('errors')->has($name);
    }

}