<?php


namespace MezzoLabs\Mezzo\Modules\General\Options;


use Illuminate\Support\Collection;

class OptionFieldRegistry
{
    /**
     * @var Collection
     */
    protected $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function register(OptionField $optionField)
    {
        $this->collection()->put($optionField->name(), $optionField);
    }

    /**
     * @param $name
     * @param $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return $this->collection()->get($name, $default);
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->collection;
    }

    /**
     * @param $name
     * @return OptionField
     */
    public function defaultOptionField($name)
    {
        return new OptionField($name, []);
    }
}