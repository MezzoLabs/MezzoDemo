<?php


namespace MezzoLabs\Mezzo\Http\Requests;


use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Controllers\Controller;
use MezzoLabs\Mezzo\Http\Controllers\ResourceControllerContract;

class ResourceRequest extends CockpitRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->controller()->model()->rules();
    }

    /**
     * @return Controller|ResourceControllerContract
     * @throws ModuleControllerException
     */
    public function controller()
    {
        $controller = parent::controller();

        if (!($controller instanceof ResourceControllerContract))
            throw new ModuleControllerException('The controller ' . $controller->qualifiedName() . ' uses a ' .
                'Resource Request. For this we need to detect the resource that the controller manages. ' .
                'Please use a correctly named ResourceController.');

        return $controller;
    }
}