<?php


use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Modules\Contents\Http\Requests\IsRequestWithContentBlocks;

class StorePageRequest extends StoreResourceRequest
{
    use IsRequestWithContentBlocks;

    public $model = \App\Page::class;

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