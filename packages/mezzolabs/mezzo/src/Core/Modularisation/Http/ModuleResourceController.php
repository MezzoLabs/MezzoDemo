<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http;


use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;

abstract class ModuleResourceController extends ModuleController
{
    /**
     * @var MezzoModelReflection
     */
    protected $modelReflection;

    /**
     * @var ModelRepository
     */
    protected $repository;

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

    /**
     * @return mixed|null
     */
    protected function guessModelName()
    {
        $shortName = Singleton::reflection($this)->getShortName();

        $possibleModelName = str_replace('Controller', '', $shortName);

        return $possibleModelName;
    }

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
     * @return ModelRepository|void
     */
    public function repository()
    {
        if(!$this->repository)
            $this->repository = $this->makeRepository();

        return $this->repository;
    }

    protected function makeRepository(){

        $guessClassName = $this->module


    }

    protected function assertResourceIsReflectedModel()
    {
        if(!$this->model())
            throw new ModuleControllerException($this->qualifiedName() . " isn't a valid resource controller. " .
                "Tried to find a Mezzo model with the name " . $this->guessModelName(). '. ' .
                'You should try <ModelName>Controller.');

        return true;
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

    /**
     * Display a listing of the resource.
     *
     * @param ModuleRequest $request
     * @return ModuleResponse
     */
    public function index(ModuleRequest $request){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return ModuleResponse
     */
    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ModuleRequest  $request
     * @return ModuleResponse
     */
    public function store(ModuleRequest $request){

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ModuleResponse
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return ModuleResponse
     */
    public function edit($id){

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ModuleRequest  $request
     * @param  int  $id
     * @return ModuleResponse
     */
    public function update(ModuleRequest $request, $id){

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return ModuleResponse
     */
    public function destroy($id){

    }
}