<?php


namespace MezzoLabs\Mezzo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Exceptions\HttpException;
use MezzoLabs\Mezzo\Http\Controllers\Controller;
use MezzoLabs\Mezzo\Http\Controllers\ResourceControllerContract;

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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->controller();

        if ($this->controller instanceof ResourceControllerContract) {
            return $this->controller->model()->rules();
        }

        return [
            //
        ];
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
        $action = (new Collection($this->route()->getAction()))->get('controller');

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