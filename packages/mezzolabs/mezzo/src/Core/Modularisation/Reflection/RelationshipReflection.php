<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\RelationConverter;
use MezzoLabs\Mezzo\Core\Schema\Relations\Relation as MezzoRelation;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Database\Column;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Schema\Relations\ManyToOne;
use MezzoLabs\Mezzo\Core\Schema\Relations\OneToOne;
use MezzoLabs\Mezzo\Exceptions\MezzoException;

class RelationshipReflection
{
    /**
     * Array of function names that are allowed relationships.
     *
     * @var array
     */
    public static $allowed = [
        'belongsTo', 'belongsToMany', 'hasMany', 'hasOne', 'hasOneOrMany'
    ];
    /**
     * @var ModelReflection
     */
    protected $modelReflection;

    /**
     * @var string
     */
    protected $functionName;

    /**
     * @var BelongsTo|BelongsToMany|HasOneOrMany
     */
    protected $instance;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var RelationshipReflection
     */
    protected $counterpart;


    /**
     * @param ModelReflection $modelReflection
     * @param $functionName
     */
    public function __construct(ModelReflection $modelReflection, $functionName)
    {
        $this->modelReflection = $modelReflection;
        $this->functionName = $functionName;

        $this->instance = $this->makeInstance();
        $this->type = $this->instanceReflection()->getShortName();

    }

    /**
     * @return Relation
     */
    private function makeInstance()
    {
        $modelInstance = $this->modelReflection->instance();
        $function = $this->functionName;
        return $modelInstance->$function();
    }

    /**
     * Check if a relation is allowed.
     *
     * @param $string
     * @return bool
     */
    public static function isAllowed($string)
    {
        return in_array(camel_case($string), static::$allowed);
    }

    /**
     * @return BelongsTo|BelongsToMany|HasOneOrMany|Relation
     */
    public function instance()
    {
        return $this->instance;
    }

    /**
     * Get a qualified name for this relationship.
     *
     * @return string
     */
    public function qualifiedName()
    {
        return $this->modelReflection->className() . '.' . $this->functionName;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->functionName;
    }

    /**
     * @return string
     */
    public function type(){
        return $this->type;
    }

    /**
     * Checks if the relation is a 'hasMany', 'hasOne'...
     *
     * @param string $type
     */
    public function is($type){
        return strtolower($type) == strtolower($this->type());
    }

    /**
     * @return \ReflectionClass
     */
    public function instanceReflection(){
        return Singleton::reflection($this->instance);
    }

    /**
     * Checks if this relation has the foreign key as a column in the connected database table.
     */
    public function isBelongsTo(){
        return $this->type == 'BelongsTo' || $this->type == 'BelongsToMany';
    }

    /**
     * Get the name of the model table
     *
     * @return string
     */
    public function tableName(){
        return $this->modelReflection->table()->name();
    }

    /**
     * Get the name of the foreign table
     *
     * @return string
     */
    public function relatedTableName(){
        return $this->instance()->getRelated()->getTable();
    }

    /**
     * Get the foreign column name without the name of the table.
     *
     * @throws MezzoException
     * @return string
     */
    public function relatedColumn(){
        switch($this->type()){
            case 'BelongsTo':       $column = $this->instance()->getOtherKey(); break;
            case 'BelongsToMany':   $column = $this->instance()->getRelated()->getKeyName(); break;
            case 'HasOne':          $column = $this->instance()->getForeignKey(); break;
            case 'HasMany':         $column = $this->instance()->getForeignKey(); break;
            default:                throw new MezzoException('Relationship ' . $this->qualifiedName() . ' is not supported. ');
        }

        return $this->disqualifyColumn($column);
    }

    /**
     * Get the qualified column of the related table.
     *
     * @return string
     * @throws MezzoException
     */
    public function qualifiedRelatedColumn(){
        return $this->relatedTableName() . '.' . $this->relatedColumn();
    }

    /**
     * Get the unqualified name of the local column.
     *
     * @throws \Exception
     * @return string
     */
    public function localColumn(){
        switch($this->type()){
            case 'BelongsTo':       $column = $this->instance()->getForeignKey(); break;
            case 'BelongsToMany':   $column = $this->instance()->getParent()->getKeyName(); break;
            case 'HasOne':          $column = $this->instance()->getQualifiedParentKeyName(); break;
            case 'HasMany':         $column = $this->instance()->getQualifiedParentKeyName(); break;
            default:                throw new MezzoException('Relationship ' . $this->qualifiedName() . ' is not supported. ');
        }

        return $this->disqualifyColumn($column);
    }

    /**
     * Get the qualified local column.
     *
     * @return string
     * @throws MezzoException
     */
    public function qualifiedLocalColumn(){
        return $this->tableName() . '.' . $this->localColumn();
    }

    /**
     * Remove the table name from a column.
     *
     * @param string $columnName
     * @return string
     */
    private function disqualifyColumn($columnName){
        if(strstr($columnName, '.'))
            return explode('.', $columnName)[1];

        return $columnName;
    }

    /**
     * Get the counterpart if this relationship reflection
     *
     * @return RelationshipReflection
     */
    public function counterpart(){
        if(!$this->counterpart){
            $counterpartModel = $this->relatedModelReflection();

            $this->counterpart = $counterpartModel->relationships()->findCounterpartTo($this);
        }

        return $this->counterpart;
    }

    public function isCounterpart(RelationshipReflection $check){
        $correctTables = $check->tableName() == $this->relatedTableName();
        $correctColumns = $check->localColumn() == $this->relatedColumn() &&
                            $check->relatedColumn() == $this->localColumn();

        return $correctTables && $correctColumns;
    }

    /**
     *
     *
     * @return ModelReflection
     */
    public function relatedModelReflection(){
        return Reflector::getReflection($this->instance()->getRelated());

    }

    /**
     * Produces a relation schema.
     *
     * @throws MezzoException
     * @throws \Reflectionxception
     * @return Relation
     */
    protected function makeRelation(){
        return RelationConverter::fromReflectionToRelation($this);
    }



}