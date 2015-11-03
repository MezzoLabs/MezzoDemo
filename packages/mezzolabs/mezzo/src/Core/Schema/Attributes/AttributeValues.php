<?php


namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use Illuminate\Support\Facades\Input;
use MezzoLabs\Mezzo\Core\Collection\StrictCollection;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoModel;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;
use MezzoLabs\Mezzo\Exceptions\HttpException;

class AttributeValues extends StrictCollection
{
    public function add(AttributeValue $value)
    {
        $this->put($value->attribute()->name(), $value);
    }

    /**
     * Only return scalar attributes that represent a column in the main table of the model.
     *
     * @return AttributeValues
     */
    public function inMainTableOnly()
    {
        return $this->filter(function (AttributeValue $value) {
            return $value->attribute()->isAtomic() || $value->isInteger();
        });
    }

    /**
     * Only return attributes that have to be updated on foreign tables.
     *
     * @return AttributeValues
     */
    public function inForeignTablesOnly()
    {
        return $this->filter(function (AttributeValue $value) {
            return !$value->attribute()->isAtomic() && !$value->isInteger();
        });
    }

    /**
     * Returns a filtered Value collection that only consists out of atomic attributes.
     *
     * @return AttributeValues
     */
    public function atomicOnly()
    {
        return $this->filter(function(AttributeValue $value){
            return $value->attribute()->isAtomic();
        });
    }

    /**
     * Returns a filtered Value collection that only consists out of relation attributes.
     *
     * @return AttributeValues
     */
    public function relationsOnly()
    {
        return $this->filter(function(AttributeValue $value){
            return $value->attribute()->isRelationAttribute();
        });
    }

    /**
     * Returns a filtered Value collection that only consists out of visible attributes.
     *
     * @return AttributeValues
     */
    public function visibleOnly()
    {
        return $this->filter(function(AttributeValue $value){
            return $value->attribute()->isVisible();
        });
    }

    protected function checkItem($value)
    {
        return $value instanceof AttributeValue;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [];

        $this->each(function(AttributeValue $value) use (&$array){
            $array[$value->name()] = $value->value();
        });

        return $array;
    }

    /**
     * @param MezzoEloquentModel $model
     * @return AttributeValues
     * @throws HttpException
     */
    public static function fromModel(MezzoEloquentModel $model)
    {
        return static::fromArray($model->schema(), $model->getAttributes());
    }

    /**
     * @param ModelSchema $model
     * @param array $data
     * @return AttributeValues
     * @throws HttpException
     */
    public static function fromInput(ModelSchema $model, $data = [])
    {
        if (empty($data))
            $data = Input::all();

        return static::fromArray($model, $data);
    }

    /**
     * @param ModelSchema $model
     * @param array $array
     * @return AttributeValues
     * @throws HttpException
     */
    public static function fromArray(ModelSchema $model, $array)
    {
        $values = new AttributeValues();

        foreach ($array as $key => $value) {
            $attribute = $model->attributes($key);

            if (!$attribute){
                throw new HttpException("\"" . $key . "\" is not a valid attribute in " . $model->className());

            }

            $value = new AttributeValue($value, $attribute);
            $values->add($value);
        }

        return $values;

    }
}