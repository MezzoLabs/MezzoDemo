<?php


namespace MezzoLabs\Mezzo\Http\Requests\Resource;

use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exception\HttpResponseException;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Http\Controllers\Controller;
use MezzoLabs\Mezzo\Http\Controllers\ResourceControllerContract;
use MezzoLabs\Mezzo\Http\Requests\Request;
use MezzoLabs\Mezzo\Http\Requests\ValidatesApiRequests;

class ResourceRequest extends Request
{
    use ValidatesApiRequests;

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
        return [];
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

    /**
     * @return \MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection
     * @throws ModuleControllerException
     */
    public function model()
    {
        return $this->controller()->model();
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator|\Illuminate\Validation\Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator)
    {
        if (!$this->isApi())
            throw new HttpResponseException($this->response(
                $this->formatErrors($validator)
            ));

        return $this->failedApiValidation($validator);
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return mixed
     */
    protected function failedAuthorization()
    {
        if (!$this->isApi())
            throw new UnauthorizedException;

        return $this->failedApiAuthorization();
    }



}