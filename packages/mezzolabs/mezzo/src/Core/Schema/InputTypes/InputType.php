<?php
/**
 * Created by: simon.schneider
 * Date: 16.09.2015 - 14:08
 * Project: MezzoDemo
 */


namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;


use Doctrine\DBAL\Types\Type;
use MezzoLabs\Mezzo\Core\Cache\Singleton;

abstract class InputType
{
    /**
     * @var \Doctrine\DBAL\Types\Type
     *
     */
    protected $doctrineType = \Doctrine\DBAL\Types\Type::STRING;

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
    public function is($compare)
    {
        $shortName = $this->reflection()->getShortName();
        return strtolower($shortName) === strtolower($compare);

    }

    /**
     * @return \ReflectionClass
     */
    public function reflection()
    {
        return Singleton::reflection(get_class($this));
    }

    /**
     * Gets the tag from the htmlTag property ("tag:type" is also allowed)
     *
     * @return string
     */
    public function htmlTag()
    {
        $tag = explode(':', $this->htmlTag)[0];
        return $tag;
    }

    /**
     * Gets the type from the htmlTag property (e.g. input:text)
     *
     * @return bool | string
     */
    public function htmlType()
    {
        $tag = explode(':', $this->htmlTag);
        if (count($tag) < 2) return false;

        return $tag[1];
    }

    /**
     * Checks if the html tag needs to be closed
     *
     * @return bool
     */
    public function htmlIsVoid()
    {
        return $this->htmlType() == "input";
    }

    /**
     * @param $type
     * @return InputType
     */
    public static function fromType($type)
    {
        $class = TextInput::class;

        //@TODO: Add more, move to config
        switch ($type) {
            case 'text':
                $class = TextArea::class;
                break;
            case 'integer':
                $class = NumberInput::class;
                break;
        }

        return new $class;
    }

    /**
     * @return \Doctrine\DBAL\Types\Type
     */
    public function doctrineTypeName()
    {
        return $this->doctrineType;
    }

    /**
     * @return Type
     * @throws \Doctrine\DBAL\DBALException
     */
    public function doctrineTypeInstance(){
        return Type::getType($this->doctrineTypeName());
    }



} 