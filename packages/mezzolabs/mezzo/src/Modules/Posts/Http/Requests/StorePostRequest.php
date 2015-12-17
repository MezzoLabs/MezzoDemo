<?php


namespace packages\mezzolabs\mezzo\src\Modules\Posts\Http\Requests;


use Illuminate\Support\Arr;
use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Modules\Contents\Http\Requests\IsRequestWithContentBlocks;

class StorePostRequest extends StoreResourceRequest
{
    use IsRequestWithContentBlocks;


    protected function makeFormObject()
    {
        return $this->makeContentBlocksFormObject();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Arr::dot(parent::rules());
    }
}