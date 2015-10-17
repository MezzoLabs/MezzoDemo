<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http;


use Dingo\Api\Routing\Helpers as ApiHelpers;
use Illuminate\Routing\Controller;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;

abstract class ModuleController extends Controller implements ModuleControllerContract
{
    use ApiHelpers;

    public function actionUri($method)
    {
        $this->hasActionOrFail($method);
    }

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






}