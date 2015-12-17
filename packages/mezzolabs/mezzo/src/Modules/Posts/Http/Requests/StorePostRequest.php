<?php


namespace packages\mezzolabs\mezzo\src\Modules\Posts\Http\Requests;


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
     * Validate the class instance.
     *
     * @return void
     */
    public function validate()
    {
        parent::validate();

        $this->validateContentBlocks();
    }
}