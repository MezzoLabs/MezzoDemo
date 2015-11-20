<?php


namespace MezzoLabs\Mezzo\Http\Requests\Resource;


abstract class UpdateOrStoreResourceRequest extends ResourceRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->modelReflection()->rules();
    }
}