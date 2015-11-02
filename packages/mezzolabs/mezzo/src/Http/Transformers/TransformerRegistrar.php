<?php


namespace MezzoLabs\Mezzo\Http\Transformers;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\TransformerException;

class TransformerRegistrar
{
    /**
     * @var Collection
     */
    protected $bindings;

    public function __construct()
    {
        $this->bindings = new Collection();
    }


    /**
     * @param string $class
     * @param string $transformer
     */
    public function register($class, $transformer)
    {
        app('Dingo\Api\Transformer\Factory')->register($class, $transformer);
        $this->bindings->put($class, $transformer);


    }

    /**
     * @param string $class
     * @param string $transformer
     * @throws InvalidArgumentException
     * @throws TransformerException
     */
    public static function addTransformer($class, $transformer)
    {
        if(!is_string($class))
            throw new InvalidArgumentException($class);

        if(!is_string($transformer))
            throw new InvalidArgumentException($transformer);

        if(!class_exists($class))
            throw new TransformerException('Cannot find class ' . $class);

        if(!class_exists($transformer))
            throw new TransformerException('Cannot find transformer ' . $transformer . ' for ' . $class);

        $registrar = static::make();
        $registrar->register($class, $transformer);
    }

    public static function addTransformers($transformers)
    {
        foreach($transformers as $class => $transformer){
            static::addTransformer($class, $transformer);
        }
    }

    public function findTransformerClass($modelClass)
    {
        if(is_string($modelClass))
            return $this->bindings->get($modelClass);

        if(is_object($modelClass))
            return $this->bindings->get(get_class($modelClass));

        if($modelClass instanceof Collection)
            return $this->bindings->get(get_class($modelClass->first()));

        throw new InvalidArgumentException($modelClass);
    }

    /**
     * @return static
     */
    public static function make()
    {
        return app(static::class);
    }

}