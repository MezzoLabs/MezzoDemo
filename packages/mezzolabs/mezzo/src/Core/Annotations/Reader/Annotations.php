<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;


use MezzoLabs\Mezzo\Core\Annotations\Attribute as AttributeAnnotation;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Annotations\Annotation as MezzoAnnotation;
use MezzoLabs\Mezzo\Core\Annotations\Relations\RelationAnnotation;
use MezzoLabs\Mezzo\Exceptions\ReflectionException;

class Annotations
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @param array $annotations
     */
    public function __construct(array $annotations)
    {
        $this->collection = new Collection();

        foreach ($annotations as $annotation) {
            if (!($annotation instanceof MezzoAnnotation)) continue;

            $this->collection->put($annotation->shortName(), $annotation);
        }
    }

    /**
     * @return mixed
     * @throws ReflectionException
     */
    public function type()
    {
        foreach ($this->collection as $annotationType => $annotation) {

            if ($annotation instanceof AttributeAnnotation) {
                return AttributeAnnotations::class;
            }

            if ($annotation instanceof RelationAnnotation)
                return RelationAnnotations::class;
        }

        return null;
    }

    public function count()
    {
        return $this->collection->count();
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->collection;
    }

    /**
     * @param string $annotationType
     * @return bool
     */
    public function have($annotationType)
    {
        return $this->collection()->has(strtolower($annotationType));
    }

    /**
     * @param $annotationType
     * @return MezzoAnnotation
     */
    public function get($annotationType)
    {
        return $this->collection()->get(strtolower($annotationType), null);
    }
}