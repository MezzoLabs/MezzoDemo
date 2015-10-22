<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories;


use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflectionSet;
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
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->query()->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->query()->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->modelInstance()->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->query()->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function delete($ids)
    {
        return $this->modelInstance()->destroy($ids);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->query()->find($id, $columns);
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
     * Create a new generic model repository for a given model class.
     *
     * @param string|ModelReflection|ModelReflectionSet $model
     * @return static
     */
    public static function make($model)
    {
        /**
         * Find the model reflection, normalize the $model variable.
         */
        $model = mezzo()->model($model);

        return new ModelRepository($model);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function modelInstance()
    {
        return $this->modelReflection->instance();
    }

}