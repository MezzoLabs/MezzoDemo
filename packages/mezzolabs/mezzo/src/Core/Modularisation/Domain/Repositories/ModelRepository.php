<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSet;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValue;
use MezzoLabs\Mezzo\Core\Schema\Attributes\AttributeValues;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\RepositoryException;

class ModelRepository
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
        $result = $this->query()->where($attribute, '=', $id)->update($values->atomicOnly()->toArray());


        $values->relationsOnly()->each(function (AttributeValue $attributeValue) use ($model) {
            $this->updateRelation($model, $attributeValue->name(), $attributeValue->value());
        });


        return $result;

    }

    /**
     * @param string $relationName
     * @param array|integer $id
     * @return array
     * @throws \Exception
     * @throws \MezzoLabs\Mezzo\Exceptions\ReflectionException
     */
    public function updateRelation(MezzoEloquentModel $model, $relationName, $id)
    {
        $relation = $model->relation($relationName);

        if ($relation instanceof BelongsToMany)
            return $this->updateBelongsToManyRelation($relation, $id);

        if ($relation instanceof HasOne)
            return $this->updateHasOneRelation($relation, $id);

        if($relation instanceof HasMany)
            return $this->updateHasManyRelation($relation, $id, $model);

        throw new \Exception('This type of relation is not yet supported');

    }

    /**
     * @param BelongsToMany $relation
     * @param array $ids
     * @return array
     */
    private function updateBelongsToManyRelation(BelongsToMany $relation, array $ids)
    {
        return $relation->sync($ids);
    }

    /**
     * Set the parent of many child resources.
     *
     * @param HasMany $relation
     * @param array $ids
     * @param MezzoEloquentModel $parent
     * @return bool
     * @throws InvalidArgumentException
     */
    private function updateHasManyRelation(HasMany $relation, array $ids, MezzoEloquentModel $parent)
    {
        $foreignKey = $relation->getPlainForeignKey();

        foreach($ids as $id){
            if(!is_integer($id))
                throw new InvalidArgumentException($id);

            $foreignModel = $relation->getRelated();
            $foreignChild = $foreignModel->newQuery()->where($foreignModel->getQualifiedKeyName(), '=', $id);
            $result = $foreignChild->update([$foreignKey => $parent->id]);

            if(!$result)
                return false;
        }

        return true;
    }

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

}