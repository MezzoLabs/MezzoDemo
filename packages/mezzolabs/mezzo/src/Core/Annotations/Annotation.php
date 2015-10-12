<?php


namespace MezzoLabs\Mezzo\Core\Annotations;

use Doctrine\Common\Annotations\Annotation as DoctrineAnnotation;

abstract class Annotation extends DoctrineAnnotation
{
    public function shortName()
    {
        $parts = explode('\\', get_class($this));

        return strtolower($parts[count($parts) - 1]);
    }
}