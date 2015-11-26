<?php


namespace Mezzolabs\Mezzo\Cockpit\Http\FormObjects;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;

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
     * Returns the table name of the models main table.
     *
     * @return string
     */
    public function table()
    {
        return $this->model()->tableName();
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

            $relationSide = $this->allRelationSides()->findOrFailByNaming($name);

            $nested->add(new NestedRelation($relationSide, $value));
        });

        return $nested;
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\Relations\RelationSides
     */
    public function allRelationSides()
    {
        return $this->model()->schema()->relationSides();
    }


    /**
     * Return all the rules of atomic attributes and nested relations in a dot notation.
     *
     * @return array
     */
    public function rules()
    {
        $modelRules = $this->model()->rules();
        $relationRules = $this->nestedRelations()->rules();

        return array_merge($modelRules, $relationRules);
    }
}