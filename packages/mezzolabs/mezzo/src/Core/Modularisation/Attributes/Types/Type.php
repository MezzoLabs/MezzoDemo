<?php
/**
 * Created by: simon.schneider
 * Date: 16.09.2015 - 14:08
 * Project: MezzoDemo
 */
 
 

namespace MezzoLabs\Mezzo\Core\Modularisation\Attributes\Types;


use MezzoLabs\Mezzo\Core\Cache\Singleton;

abstract class Type {
    protected $doctrineType = \Doctrine\DBAL\Types\Type::class;

    /**
     * Compare type to a string.
     *
     * @param $compare
     * @return bool
     */
    public function is($compare){
        $shortName = $this->reflection()->getShortName();
        return strtolower($shortName) === strtolower($compare);

    }

    /**
     * @return \ReflectionClass
     */
    public function reflection(){
        return Singleton::reflection(get_class($this));
    }

} 