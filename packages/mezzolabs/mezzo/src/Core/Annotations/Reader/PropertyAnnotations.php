<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;

use MezzoLabs\Mezzo\Exceptions\AnnotationException;
use MezzoLabs\Mezzo\Exceptions\ReflectionException;
use ReflectionProperty;


abstract class PropertyAnnotations
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Annotations
     */
    protected $annotations;

    /**
     * @param string $name
     * @param Annotations $annotations
     */
    final public function __construct($name, Annotations $annotations)
    {
        $this->name = $name;
        $this->annotations = $annotations;

        $this->validate();
    }

    /**
     * Checks if the given annotations list is correct.
     *
     * @return boolean
     */
    abstract protected function validate();

    /**
     * Read the annotations out of a property and creates the correct annotations object.
     *
     * @param AnnotationReader $reader
     * @param ReflectionProperty $property
     * @return AttributeAnnotations|RelationAnnotations|null
     */
    public static function make(AnnotationReader $reader, ReflectionProperty $property)
    {
        if (!$property->isProtected()) return null;

        $annotations = $reader->getPropertyAnnotations($property);


        if ($annotations->count() === 0) return null;

        return static::makeByAnnotationCollection($property->getName(), $annotations);

    }

    /**
     * @param $name
     * @param Annotations $annotations
     * @return AttributeAnnotations|RelationAnnotations
     * @throws \MezzoLabs\Mezzo\Exceptions\ReflectionException
     */
    protected static function makeByAnnotationCollection($name, Annotations $annotations)
    {
        $type = $annotations->type();

        if (!$type) return null;

        if ($type === RelationAnnotations::class)
            return new RelationAnnotations($name, $annotations);

        if ($type == AttributeAnnotations::class)
            return new AttributeAnnotations($name, $annotations);

        throw new ReflectionException('Unexpected annotation type :' . $type);
    }

    public function get($annotationType)
    {
        if (!$this->has($annotationType))
            throw new AnnotationException('Annotation ' . $annotationType . ' not found in ' . $this->name);

        return $this->annotations->get($annotationType);
    }

    /**
     * @param string $annotationType
     * @return bool
     */
    public function has($annotationType)
    {
        return $this->annotations->have($annotationType);
    }


}