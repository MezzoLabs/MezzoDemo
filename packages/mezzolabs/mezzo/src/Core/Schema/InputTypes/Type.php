<?php
/**
 * Created by: simon.schneider
 * Date: 16.09.2015 - 14:08
 * Project: MezzoDemo
 */
 
 

namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;


use MezzoLabs\Mezzo\Core\Cache\Singleton;

abstract class Type {
    /**
     * @var \Doctrine\DBAL\Types\Type
     *
     */
    protected $doctrineType = \Doctrine\DBAL\Types\Type::class;

    /**
     * @var string
     */
    protected $htmlTag = "input";

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

    /**
     * Gets the tag from the htmlTag property ("tag:type" is also allowed)
     *
     * @return string
     */
    public function htmlTag(){
        $tag = explode(':', $this->htmlTag)[0];
        return $tag;
    }

    /**
     * Gets the type from the htmlTag property (e.g. input:text)
     *
     * @return bool | string
     */
    public function htmlType(){
        $tag = explode(':', $this->htmlTag);
        if(count($tag) < 2) return false;

        return $tag[1];
    }

    /**
     * Checks if the html tag needs to be closed
     *
     * @return bool
     */
    public function htmlIsVoid(){
        return $this->htmlType() == "input";
    }


} 