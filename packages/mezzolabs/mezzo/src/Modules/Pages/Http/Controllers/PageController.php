<?php

namespace MezzoLabs\Mezzo\Modules\Pages\Http\Controllers;

use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\ResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;
use MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories\ContentRepository;
use MezzoLabs\Mezzo\Modules\Contents\Types\BlockTypes\ContentBlockTypeRegistrar;
use MezzoLabs\Mezzo\Modules\Pages\Http\Pages\CreatePagePage;
use MezzoLabs\Mezzo\Modules\Pages\Http\Pages\IndexPagePage;
use StorePageRequest;

class PageController extends CockpitResourceController
{
    protected function defaultData()
    {
        $blockRegistrar = ContentBlockTypeRegistrar::make();

        return [
            'blocks' => $blockRegistrar->all()
        ];
    }


    /**
     * Display a listing of the resource.
     *
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function index(ResourceRequest $request)
    {
        return $this->page(IndexPagePage::class);
    }


    public function create(ResourceRequest $request)
    {
        return $this->page(CreatePagePage::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param ResourceRequest $request
     * @return ModuleResponse
     */
    public function show(ResourceRequest $request, $id)
    {
        // TODO: Implement show() method.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function edit(ResourceRequest $request, $id)
    {
        // TODO: Implement edit() method.
    }

    public function store(StorePageRequest $request)
    {
        $content = $this->contentRepository()->createWithBlocks($request->get('blocks'));

        $page = $this->repository()->create($request->only(['title', 'teaser']));

    }

    /**
     * @return ContentRepository
     */
    protected function contentRepository()
    {
        return app()->make(ContentRepository::class);
    }
}