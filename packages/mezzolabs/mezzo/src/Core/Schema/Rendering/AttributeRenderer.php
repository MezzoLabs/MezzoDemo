<?php


namespace MezzoLabs\Mezzo\Core\Schema\Rendering;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

abstract class AttributeRenderer
{
    /**
     * @var Attribute
     */
    protected $attribute;

    /**
     * @param Attribute $attribute
     */
    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @return Attribute
     */
    public function attribute()
    {
        return $this->attribute;
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType
     */
    public function inputType()
    {
        return $this->attribute->type();
    }

    /**
     * Generate the HTML for the attribute schema.
     *
     * @return mixed
     */
    abstract public function render();

    /**
     * Create an array of html attributes for this attribute schema.
     *
     * @return Collection
     */
    abstract protected function htmlAttributes();

    public static function make(Attribute $attribute)
    {
        return app(AttributeRenderer::class, ['attribute' => $attribute]);
    }
}