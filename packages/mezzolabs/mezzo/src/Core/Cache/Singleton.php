<?php


namespace MezzoLabs\Mezzo\Core\Cache;


use Closure;
use Illuminate\Support\Collection;
use ReflectionClass;

class Singleton
{
    /**
     * @var Collection
     */
    private static $instances;


    /**
     * Get a existing instance or retrieve one from the singleton cache.
     *
     * @param $key
     * @param callable $closure
     * @return mixed
     */
    public static function get($key, Closure $closure){
        $singletons = static::instances();

        if(!$singletons->has($key)){
            $singletons->put($key, $closure());
        }

        return $singletons->get($key);

    }

    /**
     * Gives you the singleton instance of a class reflection.
     *
     * @param $class
     * @return ReflectionClass
     */
    public static function reflection($class){
        if(is_object($class))
            $class = get_class($class);

        return Singleton::get('reflection.' . $class, function() use ($class){
            return new \ReflectionClass($class);
        });

    }

    public static function instances(){
        if(!static::$instances){
            static::$instances = new Collection();
        }

        return static::$instances;
    }


} 