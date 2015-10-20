<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http;


use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Exceptions\RepositoryException;

abstract class ModuleResourceController extends ModuleController
{

    protected $allowStaticRepositories = false;

    /**
     * @var MezzoModelReflection
     */
    protected $modelReflection;

    /**
     * @var ModelRepository
     */
    protected $repository;

    /**
     * @param $model
     * @internal param $modelReflection
     */
    public function setModelReflection($model)
    {
        $modelReflection = mezzo()->model($model);

        $this->modelReflection = $modelReflection;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ModuleRequest $request
     * @return ModuleResponse
     */
    public function index(ModuleRequest $request)
    {
        return $this->repository()->all();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return ModuleResponse
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ModuleRequest $request
     * @return ModuleResponse
     */
    public function store(ModuleRequest $request)
    {
        return $this->repository()->make($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ModuleRequest $request
     * @param  int $id
     * @return ModuleResponse
     */
    public function update(ModuleRequest $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * @return ModelRepository|void
     */
    public function repository()
    {
        if (!$this->repository)
            $this->repository = $this->makeRepository();

        return $this->repository;
    }

    /**
     * @param string $repositoryClassName
     * @return static
     * @throws RepositoryException
     */
    protected function makeRepository($repositoryClassName = "")
    {
        if (empty($repositoryClassName)) {
            $repositoryClassName = $this->guessRepositoryClass();
        }

        if ($repositoryClassName && class_exists($repositoryClassName)) {
            return new $repositoryClassName;
        }

        if(!$this->allowStaticRepositories)
            throw new RepositoryException('Cannot find a repository implementation for ' .
                    $this->model()->className() . '. You should create one in the App or the module folder.');

        return ModelRepository::make($this->model());
    }

    /**
     * @return bool|string
     */
    private function guessRepositoryClass()
    {
        return ModelRepository::guessRepositoryClass($this->model()->name(), ['App', $this->guessModuleNamespace()]);
    }

    /**
     * @return mixed|null
     */
    protected function guessModelName()
    {
        $shortName = Singleton::reflection($this)->getShortName();

        $possibleModelName = str_replace('Controller', '', $shortName);

        return $possibleModelName;
    }


    private function guessModuleNamespace()
    {
        return str_replace('\\Http\\Controllers', '', Singleton::reflection($this)->getNamespaceName());
    }

    /**
     * Check if this resource controller is correctly named (<ModelName>Controller)
     *
     * @return bool
     * @throws ModuleControllerException
     */
    public function isValid()
    {
        return $this->assertResourceIsReflectedModel();

    }

    protected function assertResourceIsReflectedModel()
    {
        if (!$this->model())
            throw new ModuleControllerException($this->qualifiedName() . " isn't a valid resource controller. " .
                "Tried to find a Mezzo model with the name " . $this->guessModelName() . '. ' .
                'You should try <ModelName>Controller.');

        return true;
    }

    /**
     * @return bool|MezzoModelReflection|null
     */
    public function model()
    {
        if ($this->modelReflection === null) {
            $modelName = $this->guessModelName();

            if (!mezzo()->knowsModel($modelName))
                $this->modelReflection = false;
            else
                $this->setModelReflection($modelName);
        }

        return $this->modelReflection;
    }
}