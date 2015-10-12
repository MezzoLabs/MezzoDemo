<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;


use MezzoLabs\Mezzo\Exceptions\AnnotationException;

class AttributeAnnotations extends PropertyAnnotations
{

    public function columnName()
    {
        return $this->name;
    }


    /**
     * Checks if the given annotations list is correct.
     * @return bool
     * @throws AnnotationException
     */
    protected function validate()
    {
        if (!$this->annotations->have('attribute')) {
            throw new AnnotationException('A attribute need to have an attribute annotation.');
        }

        return true;
    }
}