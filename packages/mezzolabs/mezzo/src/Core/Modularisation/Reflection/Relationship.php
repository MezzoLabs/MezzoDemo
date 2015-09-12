<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;

class Relationship {

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
    protected  $modelReflection;

    /**
     * @var string
     */
    protected $functionName;

    /**
     * @var Relation
     */
    protected $instance;

    /**
     * @param ModelReflection $modelReflection
     * @param string $functionName
     */
    public function __construct(ModelReflection $modelReflection, $functionName){

        $this->modelReflection = $modelReflection;
        $this->functionName = $functionName;

        $this->instance = $this->makeInstance();
        $this->analyseInstance();
    }

    private function analyseInstance(){
        $class = get_class($this->instance);
    }

    /**
     * @return Relation
     */
    private function makeInstance(){
        $class = $this->modelReflection->className();
        $function = $this->functionName;
        return $class->$function();
    }

    /**
     * Check if a relation is allowed.
     *
     * @param $string
     * @return bool
     */
    public static function isAllowed($string){
        return in_array(camel_case($string), static::$allowed);
    }

}