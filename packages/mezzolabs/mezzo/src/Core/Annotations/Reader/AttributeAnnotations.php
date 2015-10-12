<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;


class AttributeAnnotations
{



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