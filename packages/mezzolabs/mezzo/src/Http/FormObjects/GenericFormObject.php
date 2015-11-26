<?php


namespace Mezzolabs\Mezzo\Cockpit\Http\FormObjects;


use Illuminate\Contracts\Validation\Validator as IlluminateValidator;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class GenericFormObject implements FormObject
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @var Collection
     */
    protected $data;

    /**
     * @param string $model
     * @param $data
     */
    public function __construct($model, $data)
    {
        $this->model = mezzo()->model($model);
        $this->data = new Collection($data);
    }

    /**
     * Validate the given data.
     *
     * @return IlluminateValidator
     */
    public function validate()
    {
        throw new \Exception('TODO');
    }

    /**
     * The reflection of the eloquent model.
     *
     * @return MezzoModelReflection
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Returns the data that was sent by the form request.
     *
     * @return array
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * Returns a collection of nested relations data.
     *
     * @return NestedRelations
     */
    public function nestedRelations()
    {
        return $this->makeNestedRelations();
    }

    /**
     * Returns a collection with the data of the received attributes that are not inside a nested relation.
     *
     * @return Collection
     */
    public function atomicAttributesData()
    {
        return $this->data->filter(function ($value) {
            return !is_array($value);
        });
    }

    /**
     * @return NestedRelations
     */
    protected function makeNestedRelations()
    {
        $nested = new NestedRelations();

        $this->data->each(function ($value, $name) use ($nested) {
            if (!is_array($value)) {
                return true;
            }

            $attribute = $this->model()->schema()->attributes($name);

            if (!$attribute->isRelationAttribute())
                throw new BadRequestHttpException($name . ' is an array of values but no nested relation.');

            $nested->add(new NestedRelation($attribute, $value));
        });

        return $nested;
    }


}