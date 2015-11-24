<?php
/**
 * Created by: simon.schneider
 * Date: 16.09.2015 - 14:08
 * Project: MezzoDemo
 */


namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;


use Doctrine\DBAL\Types\Type;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\ReflectionException;

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
     * The SQL column type of this input.
     * If the value is false variableType() will return the doctrine type string.
     *
     * @var string
     */
    protected $variableType = false;

    /**
     * @param $type
     * @param string $columnName
     * @return InputType
     */
    public static function fromColumnType($type, $columnName = "")
    {
        $inputTypeClass = static::getClassByColumn($type, $columnName);

        return new $inputTypeClass;
    }


    protected static function getClassByColumn($type, $columnName)
    {
        //@TODO: Add more, move to config

        switch ($columnName) {
            case 'id':
                return PrimaryKeyInput::class;
        }


        switch ($type) {
            case 'string':
                return TextInput::class;
            case 'text':
                return TextArea::class;
            case 'date':
            case 'datetime':
                return DateTimeInput::class;
            case 'integer':
                return NumberInput::class;
            case 'float':
                return FloatInput::class;
        }

        throw new \Exception('There is no input type for the column type: ' . $type);
    }

    /**
     * @param $type
     * @return InputType
     * @throws InvalidArgumentException
     */
    public static function make($type)
    {
        if ($type instanceof InputType)
            return $type;

        if(!is_string($type))
            throw new InvalidArgumentException($type);

        if (class_exists($type))
            return new $type();

        $longClassName = static::namespaceName() . '\\' . $type;

        if (class_exists($longClassName)){
            return new $longClassName;
        }

        throw new ReflectionException("\"". $type . "\" isn't a valid InputType.");
    }

    protected static function namespaceName()
    {
        $reflection = Singleton::reflection(static::class);

        return $reflection->getNamespaceName();
    }

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
     * Checks if the html tag needs to be closed
     *
     * @return bool
     */
    public function htmlIsVoid()
    {
        return $this->htmlType() == "input";
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

    public function sqlColumnType()
    {
        return $this->doctrineTypeInstance()->getSQLDeclaration(array());
    }

    /**
     * @return Type
     * @throws \Doctrine\DBAL\DBALException
     */
    public function doctrineTypeInstance()
    {
        return Type::getType($this->doctrineTypeName());
    }

    /**
     * @return \Doctrine\DBAL\Types\Type
     */
    public function doctrineTypeName()
    {
        return $this->doctrineType;
    }

    /**
     * @return string
     */
    public function variableType()
    {
        if (!$this->variableType) return ' ' . $this->doctrineType;

        return $this->variableType;
    }

    public function name()
    {
        $namespaceParts = explode('\\', static::class);
        return end($namespaceParts);
    }


    public function isRelation()
    {
        return $this instanceof RelationInput;
    }


}