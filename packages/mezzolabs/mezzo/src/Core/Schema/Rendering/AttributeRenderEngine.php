<?php


namespace MezzoLabs\Mezzo\Core\Schema\Rendering;


use Collective\Html\FormBuilder;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

abstract class AttributeRenderEngine
{
    public static $handlers = [];

    /**
     * @return AttributeRenderEngine
     */
    public static function make()
    {
        return app(AttributeRenderEngine::class);
    }

    /**
     * Generate the HTML for the attribute schema.
     *
     * @param Attribute $attribute
     * @param array $options
     * @return string
     * @throws AttributeRenderingException
     */
    public function render(Attribute $attribute, array $options = [])
    {
        foreach ($this->handlers() as $handlerClass) {
            $handler = $this->makeHandler($handlerClass, $attribute);

            if (!$handler->handles($attribute->type())) continue;

            $handler->setOptions($options);

            return $handler->before() . $handler->render() . $handler->after();
        }

        throw new AttributeRenderingException('There is no attribute rendering ' .
            'handler for "' . get_class($attribute->type()) . '"');
    }

    /**
     * Create an array of html attributes for this attribute schema.
     *
     * @param Attribute $attribute
     * @return Collection
     */
    abstract public function htmlAttributes(Attribute $attribute);

    /**
     * @return FormBuilder
     */
    public function formBuilder()
    {
        return app(FormBuilder::class);
    }

    /**
     * @return Collection
     */
    public function handlers()
    {
        return new Collection(static::$handlers);
    }

    /**
     * @param $handlerClass
     * @param Attribute $attribute
     * @return AttributeRenderingHandler
     */
    public function makeHandler($handlerClass, Attribute $attribute)
    {
        return app()->make($handlerClass, ['attribute' => $attribute]);
    }

    public static function registerHandler($handlerClass)
    {
        array_unshift(static::$handlers, $handlerClass);
    }


}