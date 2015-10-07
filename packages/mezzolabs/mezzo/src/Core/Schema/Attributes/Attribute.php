<?php

namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use ArrayAccess;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;
use MezzoLabs\Mezzo\Core\Schema\Relations\OneToOneOrMany;
use MezzoLabs\Mezzo\Core\Schema\ValidationRules\Rules;

class Attribute
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var InputType
     */
    protected $type;

    /**
     * @var Collection
     */
    protected $options;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var ModelSchema
     */
    protected $model;

    /**
     * @var bool
     */
    protected $persisted = true;

    /**
     * @var Rules
     */
    protected $rules;

    /**
     * Get the html attributes as array.
     *
     * @return array
     */
    public function htmlAttributes()
    {
        $attributes = [
            'type' => $this->type->htmlType(),
            'name' => $this->name,
        ];

        return array_filter($attributes);
    }

    /**
     * @return string
     */
    public function getTable()
    {
        if (!empty($this->table))
            return $this->table;

        if ($this->model)
            return $this->model->tableName();

        return "";
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return bool
     */
    public function hasTable()
    {
        return !empty($this->getTable());
    }

    /**
     * @return boolean
     */
    public function isPersisted()
    {
        return $this->persisted;
    }

    /**
     * @param boolean $persisted
     */
    public function setPersisted($persisted)
    {
        $this->persisted = $persisted;
    }

    /**
     * @return ModelSchema
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param ModelSchema $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return boolean
     */
    public function hasModel()
    {
        return !$this->model;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return InputType
     */
    public function type()
    {
        return $this->type;
    }

    public function isAtomic()
    {
        return $this instanceof AtomicAttribute;
    }

    public function isForeignKey()
    {
        if (!($this instanceof RelationAttribute)) return false;

        $relation = $this->relation();

        if ($relation instanceof OneToOneOrMany)
            return $relation->joinColumn() == $this->name();
        else
            return true;
    }

    /**
     * @return Rules
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     * Check if this attribute has rules.
     *
     * @return bool
     */
    public function hasRules()
    {
        return $this->rules()->count() > 0;
    }


    /**
     * @param array|ArrayAccess $options
     */
    protected function setOptions($options)
    {
        $this->options = new Collection($options);

        $this->rules = $this->options->get('rules', new Rules());
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function qualifiedName()
    {
        return $this->getTable() . '.' . $this->name();
    }
} 