<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use MezzoLabs\Mezzo\Core\Cache\ResourceExistsCache;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSet;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValue;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValues;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\RepositoryException;

class ModelRepository extends EloquentRepository
{
    /**
     * @var MezzoModelReflection
     */
    protected $modelReflection;

    /**
     * The class name of the model.
     *
     * @var string
     */
    protected $model;

    /**
     * @param ModelReflection|null $modelReflection
     * @throws RepositoryException
     */
    public final function __construct(ModelReflection $modelReflection = null)
    {
        if (!$modelReflection) {
            $modelReflection = $this->guessModel();
        }
        $this->modelReflection = $modelReflection;

        if (!$this->modelReflection)
            throw new RepositoryException('Cannot find a model for repository "' . get_class($this) . '" .');

        $this->model = $this->modelReflection->className();
    }

    /**
     * @return ModelReflection
     */
    private function guessModel()
    {
        $modelName = $this->guessModelName();

        return mezzo()->model($modelName);
    }

    /**
     * Try to find a model that fits the repository class name (<ModelName>Repository.php)
     *
     * @return string
     */
    private function guessModelName()
    {
        return str_replace('Repository', '', Singleton::reflection(static::class)->getShortName());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->modelReflection->instance()->newQuery();
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function all($columns = array('*'))
    {
        return $this->query()->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->query()->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        //TODO Check for Relations
        $values = $this->values($data);
        return $this->modelInstance()->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return int
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $values = $this->values($data);

        $model = $this->findByOrFail($attribute, $id);


        $result = $this->updateRow($values->inMainTableOnly(), $id, $attribute);

        $relationResult = $this->updateRelations($model, $values->inForeignTablesOnly());

        return $result;
    }

    /**
     *
     *
     * @param AttributeValues $atomicAttributes
     * @param $id
     * @param $attribute
     * @return int
     */
    protected function updateRow(AttributeValues $atomicAttributes, $id, $attribute)
    {
        $values = $atomicAttributes->toArray();

        if (empty($values))
            return 1;

        return $this->query()->where($attribute, '=', $id)->update($values);

    }

    /**
     * @param MezzoEloquentModel $model
     * @param AttributeValues $relationAttributes
     * @return bool
     */
    protected function updateRelations(MezzoEloquentModel $model, AttributeValues $relationAttributes)
    {
        $relationAttributes->each(function (AttributeValue $attributeValue) use ($model) {
            $relationUpdater = new RelationUpdater($model, $attributeValue);
            $relationUpdate = $relationUpdater->run();

            if (!$relationUpdate)
                throw new RepositoryException('Cannot update the relation ' . $attributeValue->name());
        });

        return true;
    }

    /**
     * @param string $relationName
     * @param array|integer $id
     * @return array
     * @throws \Exception
     * @throws \MezzoLabs\Mezzo\Exceptions\ReflectionException
     */
    protected function updateRelation(MezzoEloquentModel $model, AttributeValue $attributeValue)
    {


        $id = $attributeValue->value();
        $relationName = $attributeValue->name();
        $eloquentRelation = $model->relation($relationName);
        $relationSchema = $model->schema()->relations()->get($relationName);
        $relationSide = $attributeValue->attribute()->relationSide();

        /**
         * m:n Relation -> update the Pivot
         */
        if ($relationSchema->isManyToMany())
            return $this->updateBelongsToManyRelation($eloquentRelation, $id);




        /**
         * 1:n Relation (Left side) -> update the child rows in the foreign table
         */
        if ($eloquentRelation instanceof BelongsTo)


            /**
             * 1:1 Relation or n:1 (Left side) -> Exception, use the column instead (updateRow)
             */
            if ($eloquentRelation instanceof HasOne)
                throw new RepositoryException('You should not update the relation "' . $relationName . '". Use the column instead.');

        throw new \Exception('This type of relation is not yet supported');

    }


    /**
     * @param HasOne $relation
     * @param $id
     * @throws InvalidArgumentException
     */
    private function updateHasOneRelation(HasOne $relation, $id)
    {
        if (!is_integer($id))
            throw new InvalidArgumentException($id);


        mezzo_dd($relation);

    }

    /**
     * @param $relation
     * @return BelongsToMany|Relation
     */
    protected function getRelation($relation)
    {
        return $this->modelInstance()->$relation();
    }

    /**
     * @param $ids
     * @return int
     */
    public function delete($ids)
    {
        return $this->modelInstance()->destroy($ids);
    }

    /**
     * @param $id
     * @param array $columns
     * @return MezzoEloquentModel
     */
    public function find($id, $columns = array('*'))
    {
        return $this->query()->find($id, $columns);
    }


    /**
     * @param $id
     * @param array $columns
     * @return Collection|MezzoEloquentModel
     */
    public function findOrFail($id, $columns = array('*'))
    {
        return $this->query()->findOrFail($id, $columns);
    }


    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->query()->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findByOrFail($attribute, $value, $columns = ['*'])
    {
        $found = $this->findBy($attribute, $value, $columns);

        if (!$found)
            throw new ModelNotFoundException();

        return $found;
    }

    /**
     * Create a new generic model repository for a given model class.
     *
     * @param string|ModelReflection|ModelReflectionSet $model
     * @return static
     */
    public static function makeRepository($model)
    {
        /**
         * Find the model reflection, normalize the $model variable.
         */
        $model = mezzo()->model($model);

        return new ModelRepository($model);

    }



    /**
     * @param array $data
     * @return AttributeValues
     */
    protected function values(array $data)
    {
        return AttributeValues::fromArray($this->modelSchema(), $data);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function modelInstance()
    {
        return $this->modelReflection->instance();
    }

    /**
     * @return MezzoModelReflection
     */
    public function modelReflection()
    {
        return $this->modelReflection;
    }


    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\ModelSchema
     */
    public function modelSchema()
    {
        return $this->modelReflection()->schema();
    }

    public function exists($id, $table = null)
    {
        if (!$table) $table = $this->modelReflection()->tableName();

        return parent::exists($id, $table);
    }


}