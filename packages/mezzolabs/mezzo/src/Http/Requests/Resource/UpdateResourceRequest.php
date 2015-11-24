<?php


namespace MezzoLabs\Mezzo\Http\Requests\Resource;


class UpdateResourceRequest extends UpdateOrStoreResourceRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->modelReflection()->instance()->getUpdateRules($this->all());
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
    protected function id()
    {
        return intval($this->route('id'));
    }
}