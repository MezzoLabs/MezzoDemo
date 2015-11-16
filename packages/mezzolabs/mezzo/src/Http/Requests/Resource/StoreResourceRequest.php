<?php


namespace MezzoLabs\Mezzo\Http\Requests\Resource;


class StoreResourceRequest extends UpdateOrStoreResourceRequest
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

}