<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSet;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValue;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValues;
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
     * Create a new generic model repository for a given model class.
     *
     * @param string|ModelReflection|ModelReflectionSet $model
     * @return static
     * @throws RepositoryException
     */
    public static function makeRepository($model = null)
    {
        if ($model) {
            /**
             * Find the model reflection, normalize the $model variable.
             */
            $model = mezzo()->model($model);

            return new ModelRepository($model);
        }

        if (static::class === ModelRepository::class)
            throw new RepositoryException('You need a model for a generic model repository.');

        return mezzo()->make(static::class);
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
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->modelReflection->instance()->newQuery();
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
        $values = $this->values($data)->inMainTableOnly();

        $modelInstance = $this->modelInstance();
        $modelInstance->fill($values->toArray());

        $modelInstance->save(['timestamps' => true]);

        return $modelInstance;
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
     * @return \MezzoLabs\Mezzo\Core\Schema\ModelSchema
     */
    public function modelSchema()
    {
        return $this->modelReflection()->schema();
    }

    /**
     * @return MezzoModelReflection
     */
    public function modelReflection()
    {
        return $this->modelReflection;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function modelInstance()
    {
        return $this->modelReflection->instance(true);
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

        $result = $this->updateRow($values->inMainTableOnly(), $model);

        $relationResult = $this->updateRelations($model, $values->inForeignTablesOnly());

        if (!$relationResult)
            $result = -1;

        return $result;
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
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return null
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->query()->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @param AttributeValues $atomicAttributes
     * @param MezzoEloquentModel $model
     * @return MezzoEloquentModel
     */
    protected function updateRow(AttributeValues $atomicAttributes, MezzoEloquentModel $model)
    {
        $values = $atomicAttributes->toArray();

        if (empty($values))
            return $model;

        $model->update($values);

        return $model;
    }

    /**
     * @param MezzoEloquentModel $model
     * @param AttributeValues $relationAttributes
     * @return bool
     */
    protected function updateRelations(MezzoEloquentModel $model, AttributeValues $relationAttributes)
    {
        $relationAttributes->each(function (AttributeValue $attributeValue) use ($model) {
            $result = $this->updateRelation($model, $attributeValue);
            if (!$result)
                throw new RepositoryException('Cannot update the relation ' . $attributeValue->name());
        });

        return true;
    }

    /**
     * @param MezzoEloquentModel $model
     * @param AttributeValue $attributeValue
     * @return array
     * @throws RepositoryException
     */
    protected function updateRelation(MezzoEloquentModel $model, AttributeValue $attributeValue)
    {
        $relationUpdater = new RelationUpdater($model, $attributeValue);
        return $relationUpdater->run();
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

    public function exists($id, $table = null)
    {
        if (!$table) $table = $this->modelReflection()->tableName();

        return parent::exists($id, $table);
    }

    /**
     * @param $relation
     * @return BelongsToMany|Relation
     */
    protected function getRelation($relation)
    {
        return $this->modelInstance()->$relation();
    }


}