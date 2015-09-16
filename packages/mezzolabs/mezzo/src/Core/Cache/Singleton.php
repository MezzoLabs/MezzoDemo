<?php


namespace MezzoLabs\Mezzo\Core\Cache;


use Closure;
use Illuminate\Support\Collection;

class Singleton
{
    /**
     * @var Collection
     */
    private static $instances;


    public static function get($key, Closure $closure){
        $singletons = static::instances();

        if(!$singletons->has($key)){
            $singletons->put($key, $closure());
        }

        return $singletons->get($key);

    }

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