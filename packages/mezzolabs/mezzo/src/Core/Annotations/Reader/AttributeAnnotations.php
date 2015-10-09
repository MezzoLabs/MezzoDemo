<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;


class AttributeAnnotations
{
    /**
     * @var string
     */
    protected $attributeName;
    /**
     * @var ModelAnnotations
     */
    private $modelAnnotations;

    /**
     * @param ModelAnnotations $modelAnnotations
     * @param string $attributeName
     */
    public function __construct(ModelAnnotations $modelAnnotations, $attributeName)
    {
        $this->modelAnnotations = $modelAnnotations;
        $this->attributeName = $attributeName;

    }
}