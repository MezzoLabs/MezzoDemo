<?php


namespace MezzoLabs\Mezzo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Exceptions\HttpException;
use MezzoLabs\Mezzo\Http\Controllers\Controller;

class CockpitRequest extends FormRequest
{
    /**
     * @var CockpitRequest
     */
    protected static $current;

    /**
     * @var Controller
     */
    protected $controller;


    /**
     * @return CockpitRequest
     */
    public static function capture()
    {
        if (!static::$current)
            static::$current = parent::capture();

        return static::$current;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

    }

    /**
     * @return Controller
     * @throws HttpException
     */
    public function controller()
    {
        if (!$this->controller)
            $this->controller = $this->detectControllerFromRoute();

        return $this->controller;
    }

    protected function detectControllerFromRoute()
    {
        $actionData = (new Collection($this->route()->getAction()));
        $action = $actionData->get('controller');

        if (!$action)
            $action = $actionData->get('uses');

        if (!$action)
            throw new HttpException('No controller found for this request. ' .
                'We need a controller for cockpit requests because we want to validate them based on the class name.');

        $controller = explode('@', $action)[0];

        $controller = mezzo()->make($controller);

        if (!($controller instanceof Controller))
            throw new HttpException('The controller has to be ' . Controller::class);

        return $controller;
    }
}