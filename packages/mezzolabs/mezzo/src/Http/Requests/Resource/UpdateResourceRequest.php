<?php


namespace MezzoLabs\Mezzo\Http\Requests\Resource;


use MezzoLabs\Mezzo\Core\Validation\Validator;

class UpdateResourceRequest extends UpdateOrStoreResourceRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        return Validator::removeRequiredRules($rules);
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->permissionGuard()->allowsEdit($this->currentModelInstance());
    }

    /**
     * @return int
     */
    protected function id(){
        return intval($this->route('id'));
    }
}