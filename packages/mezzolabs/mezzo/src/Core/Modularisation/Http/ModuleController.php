<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http;


use Dingo\Api\Routing\Helpers as ApiHelpers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;

abstract class ModuleController extends Controller implements ModuleControllerContract
{
    use ApiHelpers;

    /**
     * @var Collection
     */
    private $data;


    /**
     * @var ModuleProvider
     */
    protected $module;

    /**
     * @param $method
     * @return bool
     * @throws ModuleControllerException
     */
    public function hasActionOrFail($method)
    {
        if (!$this->hasAction($method))
            throw new ModuleControllerException("The controller " . $this->qualifiedName() .
                " doesn't support the action " . $method);

        return true;
    }

    /**
     * Check if a controller implements a certain action.
     *
     * @param $method
     * @return bool
     */
    public function hasAction($method)
    {
        if (!is_string($method))
            return false;

        return method_exists($this, $method);
    }

    /**
     * @return string
     */
    public function qualifiedName()
    {
        return get_class($this);
    }

    public function qualifiedActionName($method)
    {
        $this->hasActionOrFail($method);

        return get_class($this) . '@' . $method;
    }

    /**
     * @return string
     */
    public function slug()
    {
        return snake_case(Singleton::reflection($this)->getShortName());
    }

    /**
     * @return bool
     */
    public function isResourceController()
    {
        if(!$this instanceof ModuleResourceController)
            return false;

        if(!$this->isValid())
            return false;

        return true;
    }

    /**
     * @param null $key
     * @param null $value
     * @return Collection
     */
    public function data($key = null, $value = null)
    {
        if(!$this->data)
            $this->data = new Collection();

        if($key !== null && $value !== null){
            $this->data->put($key, $value);
        }

        if(is_array($key))
            $this->addData($key);

        if($key){
            $this->data->get($key);
        }

        return $this->data;
    }

    /**
     * Add data to the controller data, which will later be passed to the view.
     *
     * @param $toAdd
     * @return Collection|static
     */
    public function addData(array $toAdd)
    {
        $this->data = $this->data()->merge($toAdd);
        return $this->data;
    }

    public function isValid()
    {
        if(!$this->module())
            throw new ModuleControllerException('A module controller has to be inside a module folder.');
    }

    /**
     * @return ModuleProvider
     * @throws ModuleControllerException
     */
    public function module()
    {
        if(!$this->module)
            $this->module = $this->findModule();

        return $this->module;
    }

    /**
     * @return ModuleProvider
     * @throws ModuleControllerException
     */
    protected function findModule()
    {
        $controllerClass = get_class($this);
        $moduleNamespaceEnd = strpos($controllerClass, 'Http\Controllers');

        if($moduleNamespaceEnd === -1)
            throw new ModuleControllerException("This module controller isn't located inside a real module. " .
                "Check if the controller is inside the Http\\Controlelrs Folder.");

        $moduleNamespace = explode('\\', substr($controllerClass, 0, $moduleNamespaceEnd - 1));
        $moduleKey = $moduleNamespace[count($moduleNamespace) - 1];

        return mezzo()->module($moduleKey);
    }

    /**
     * @return ModuleRequest
     */
    protected function request(){
        return mezzo()->makeRequest();
    }


}