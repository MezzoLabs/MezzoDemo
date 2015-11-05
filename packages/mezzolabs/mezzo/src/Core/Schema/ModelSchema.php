<?php

namespace MezzoLabs\Mezzo\Core\Schema;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Core\Schema\Relations\RelationSide;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;

class ModelSchema
{

    /**
     * @var string
     */
    protected $className;

    /**
     * @var string
     */
    protected $shortName;

    /**
     * @var ModelTables
     */
    protected $tables;

    /**
     * @param string $className
     * @param bool $tableName
     */
    public function __construct($className, $tableName = false)
    {
        $this->className = $className;

        $this->tables = new ModelTables();
        $this->tables->setModel($this);

        $this->addMainTable($tableName);
    }

    /**
     * @param $tableName
     */
    public function addMainTable($tableName)
    {
        if (empty($tableName)) $tableName = $this->defaultTableName();

        $this->tables->addMainTable(new TableSchema($tableName));
    }

    /**
     * @return string
     */
    public function tableName()
    {
        return $this->mainTable()->name();
    }

    /**
     * @return string
     */
    public function defaultTableName()
    {
        return str_replace('\\', '', Str::snake(Str::plural(class_basename($this->className))));
    }

    /**
     * @param Attribute $attribute
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     */
    public function addAttribute(Attribute $attribute)
    {
        $attribute->setModel($this);

        return $this->tables->addAttribute($attribute);
    }

    /**
     * @return Attributes|Attribute
     */
    public function attributes($name = null)
    {
        if (!$name)
            return $this->mainTable()->attributes();

        return $this->mainTable()->attributes()->get($name);
    }

    /**
     * Get attributes from all tables.
     * Not only the main table that is connected to the model but also the tables that are connected via relations.
     *
     * @return Attributes\Attributes
     */
    public function allAttributes()
    {
        return $this->tables->attributes();
    }

    /**
     * @return TableSchema
     */
    public function mainTable()
    {
        return $this->tables->main();
    }

    /**
     * Check if this model contains a certain attribute.
     *
     * @param $attribute
     * @return bool
     * @throws InvalidArgumentException
     * @internal param $name
     */
    public function hasAttribute($attribute)
    {
        if ($attribute instanceof Attribute)
            $attribute = $attribute->name();

        if (!is_string($attribute))
            throw new InvalidArgumentException($attribute);

        return $this->attributes()->has($attribute);
    }

    /**
     * @return string
     */
    public function className()
    {
        return $this->className;
    }

    /**
     * Get the short name of this model. (Tutorial instead of App\Tutorial)
     *
     * @return string
     */
    public function shortName()
    {
        if (!$this->shortName) $this->shortName = $this->makeShortName();
        return $this->shortName;
    }

    /**
     *
     *
     * @return RelationSchemas
     */
    public function relations()
    {
        $allAttributes = $this->allAttributes();

        $relationAttributes = $allAttributes->relationAttributes();

        $relations = new RelationSchemas();

        $relationAttributes->each(function (RelationAttribute $relationAttribute) use ($relations) {
            $relations->addRelation($relationAttribute->relation());
        });

        return $relations;
    }

    /**
     * Return all relation sides of this model.
     * They represent the relations and the position of the current model in the relation.
     *
     * @return Collection
     */
    public function relationSides()
    {
        $allAttributes = $this->allAttributes();

        $relationAttributes = $allAttributes->relationAttributes();

        $relationSides = new Collection();
        $table = $this->tableName();

        $relationAttributes->each(function (RelationAttribute $relationAttribute) use ($relationSides, $table) {
            $relationSide = new RelationSide($relationAttribute->relation(), $table);
            $relationSides->put($relationAttribute->qualifiedName(), $relationSide);
        });

        return $relationSides;
    }

    /**
     * Get the short class name of the given full class name.
     *
     * @return string
     */
    private function makeShortName()
    {
        $nameSpaceFolders = explode('\\', $this->className());

        return $nameSpaceFolders[count($nameSpaceFolders) - 1];
    }

    public function toArray()
    {
        $attributesArray = array();
        $this->attributes()->each(function (Attribute $attribute) use (&$attributesArray) {
            $attributesArray[$attribute->name()] = [
                'type' => $attribute->type()->name(),
                'returnType' => $attribute->type()->doctrineTypeName()
            ];
        });

        $relationsArray = array();
        $this->relationSides()->each(function (RelationSide $side) use (&$relationsArray) {
            $relationsArray[$side->naming()] = [
                'type' => $side->relation()->shortType(),
                'children' => ($side->hasOneChild()) ? 'one' : 'many'
            ];
        });

        return [
            'attributes' => $attributesArray,
            'relations' => $relationsArray
        ];
    }
} 