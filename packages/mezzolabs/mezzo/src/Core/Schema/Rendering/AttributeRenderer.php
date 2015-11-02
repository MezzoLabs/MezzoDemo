<?php


namespace MezzoLabs\Mezzo\Core\Schema\Rendering;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Annotations\Relations\RelationAnnotation;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AtomicAttribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;

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

    public static function make(Attribute $attribute)
    {
        return app(AttributeRenderer::class, ['attribute' => $attribute]);
    }

    /**
     * @return Attribute|AtomicAttribute|RelationAttribute
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
}