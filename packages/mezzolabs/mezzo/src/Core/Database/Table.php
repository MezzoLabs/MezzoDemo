<?php


namespace MezzoLabs\Mezzo\Core\Database;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;

class Table {

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Collection
     */
    protected $columns;

    /**
     * @var Model
     */
    protected $instance;

    /**
     * @var ModelReflection
     */
    private $wrapper;


    public function __construct($name){

        $this->name =  $name;
    }

    public function columns(){
        return $this->columns;
    }

    public function name(){
        return $this->name;
    }

    public static function fromWrapper(ModelReflection $wrapper){
        $name =  $wrapper->instance()->getTable();
        $instance = $wrapper->instance();

        $table = new Table($name);
        $table->setWrapper($wrapper);
        $table->instance = $instance;

        return $table;
    }

    /**
     * @return ModelReflection
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * @param ModelReflection $wrapper
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;
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