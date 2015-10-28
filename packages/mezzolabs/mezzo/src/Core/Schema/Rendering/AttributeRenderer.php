<?php


namespace MezzoLabs\Mezzo\Core\Schema\Rendering;


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
     * Generate the HTML for the attribute schema.
     *
     * @return mixed
     */
    abstract public function render();

    public static function make()
    {
        return app(AttributeRenderer::class);
    }
}