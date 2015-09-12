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

    public static function instances(){
        if(!static::$instances){
            static::$instances = new Collection();
        }

        return static::$instances;
    }


} 