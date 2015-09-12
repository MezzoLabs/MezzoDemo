<?php


namespace MezzoLabs\Mezzo\Core\Database;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;

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
     * @var ModelReflection
     */
    private $reflection;

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
     * @param $model
     */
    public function __construct($model){
        $this->model = $model;

        $this->schema = new TableSchema();
        $this->reflection = Reflector::getReflection($model);
        $this->instance = $this->reflection->instance();
        $this->name = $this->instance->getTable();

    }

    /**
     * @return Collection
     */
    public function columns(){
        if($this->schema->columns()->count() == 0){
            $this->schema->readFromDatabase($this);
        }

        return $this->schema->columns();
    }

    /**
     * @return string
     */
    public function name(){
        return $this->name;
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
     * @return ModelReflection
     */
    public function getReflection()
    {
        return $this->reflection;
    }

    /**
     * @param ModelReflection $wrapper
     */
    public function setReflection($wrapper)
    {
        $this->reflection = $wrapper;
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

} 