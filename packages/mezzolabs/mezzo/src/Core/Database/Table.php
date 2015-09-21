<?php


namespace MezzoLabs\Mezzo\Core\Database;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Database\Column;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\RelationshipReflection;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\RelationshipReflections;
use MezzoLabs\Mezzo\Core\Database\Columns;

class Table {

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Model
     */
    protected $instance;

    /**
     * Class name of the model
     *
     * @var string
     */
    private $model;

    /**
     * @var Columns
     */
    protected $columns;

    /**
     * @var ModelReflection
     */
    protected $reflection;

    /**
     * @var Collection
     */
    protected $connectingColumns;

    /**
     * @param $model
     */
    public function __construct($model){
        $this->model = $model;

        $this->reflection = Reflector::getReflection($model);
        $this->instance = $this->reflection->instance();
        $this->columns = new Columns($this);

    }

    /**
     * @return Collection
     */
    public function allColumns(){
        return $this->columns()->all();
    }

    /**
     * @return Columns
     */
    public function columns(){
        if($this->columns->all()->count() == 0){
            $this->columns->readFromDatabase($this);
        }

        return $this->columns;
    }

    /**
     * @param Column $column
     * @return string
     */
    public function qualifiedColumnName(Column $column){
        return $this->name() . '.' . $column->name();
    }

    /**
     * @return string
     */
    public function name(){
        return $this->columns->name();
    }

    /**
     * @param ModelReflection $wrapper
     * @return Table
     */
    public static function fromModelReflection(ModelReflection $wrapper){
        $instance = $wrapper->instance();
        $table = new Table(get_class($instance));
        return $table;
    }


    /**
     * @return Model
     */
    public function instance()
    {
        return $this->instance;
    }

    /**
     * @param Model $instance
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
    }

    /**
     * @return RelationshipReflections
     */
    public function relationships(){
        return $this->reflection->relationships();
    }

    /**
     * @return Collection
     */
    public function connectingColumns(){
        if(!$this->connectingColumns)
            $this->connectingColumns = mezzo()->reflector()->relationsSchema()->connectingColumns($this->name());

        return $this->connectingColumns;
    }

} 