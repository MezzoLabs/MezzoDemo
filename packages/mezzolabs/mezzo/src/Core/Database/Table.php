<?php


namespace MezzoLabs\Mezzo\Core\Database;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Database\Column;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;
use MezzoLabs\Mezzo\Core\Schema\TableSchema;

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
     * @var TableSchema
     */
    protected $schema;

    /**
     * @var ModelReflection
     */
    protected $reflection;

    /**
     * @param $model
     */
    public function __construct($model){
        $this->model = $model;

        $this->reflection = Reflector::getReflection($model);
        $this->instance = $this->reflection->instance();
        $this->schema = new TableSchema($this->instance->getTable());
    }

    /**
     * @return Collection
     */
    public function columns(){
        if($this->schema->columns()->count() == 0){
            $this->schema->fillWithRealTable($this);
        }

        return $this->schema->columns();
    }

    public function atomicColumns(){
        return $this->columns()->filter(function($column){
            return !$this->columnIsForeignKey($column);
        });
    }

    public function foreignKeyColumns(){
        return $this->columns()->filter(function($column){
            return $this->columnIsForeignKey($column);
        });
    }

    public function columnIsForeignKey(Column $column){
        foreach($this->relationships() as $relationShip){

        }
    }

    /**
     * @return string
     */
    public function name(){
        return $this->schema->name();
    }

    /**
     * @param ModelReflection $wrapper
     * @return Table
     */
    public static function fromWrapper(ModelReflection $wrapper){
        $instance = $wrapper->instance();
        $table = new Table(get_class($instance));
        return $table;
    }


    /**
     * @return Model
     */
    public function getInstance()
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
     * @return Collection
     */
    public function relationships(){
        return $this->reflection->relationships();
    }
} 