<?php

namespace MezzoLabs\Mezzo\Modules\Contents\Http\ApiControllers;


use MezzoLabs\Mezzo\Http\Controllers\ApiController;
use MezzoLabs\Mezzo\Modules\Contents\Http\Transformers\ContentBlockTypeTransformer;
use MezzoLabs\Mezzo\Modules\Contents\Types\BlockTypes\ContentBlockTypeRegistrar;

class ContentBlockTypeApiController extends ApiController
{
    public function index()
    {
        return $this->response()->collection($this->typeRegistrar()->all(), new ContentBlockTypeTransformer());
    }

    public function show($hash)
    {
        return $this->response()->item($this->typeRegistrar()->get($hash, null), new ContentBlockTypeTransformer());
    }

    /**
     * @return ContentBlockTypeRegistrar
     */
    protected function typeRegistrar()
    {
        return app()->make(ContentBlockTypeRegistrar::class);
    }
}