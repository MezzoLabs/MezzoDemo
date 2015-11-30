<?php


namespace MezzoLabs\Mezzo\Http\Requests\Resource;


class UpdateResourceRequest extends UpdateOrStoreResourceRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->isTemplateRequest())
            return $this->permissionGuard()->allowsEdit($this->newModelInstance());

        return $this->permissionGuard()->allowsEdit($this->currentModelInstance());
    }

    /**
     * @return int
     */
    protected function id()
    {
        return intval($this->route('id'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->formObject()->rulesForUpdating();
    }
}