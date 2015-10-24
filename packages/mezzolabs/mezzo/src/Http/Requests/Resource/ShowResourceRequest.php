<?php


namespace MezzoLabs\Mezzo\Http\Requests\Resource;


class ShowResourceRequest extends ResourceRequest
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