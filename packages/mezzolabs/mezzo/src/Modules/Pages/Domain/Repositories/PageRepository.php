<?php


namespace MezzoLabs\Mezzo\Modules\Pages\Domain\Repositories;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories\ContentRepository;

class PageRepository extends ModelRepository
{
    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $data = new Collection($data);
        $attributesData = new Collection($data);
        $attributesData->forget(['blocks']);

        $content = $this->contentRepository()->createWithBlocks($data->get('blocks'));

        $attributesData->put('content_id', $content->id);

        return parent::create($attributesData->toArray());
    }

    /**
     * @return ContentRepository
     */
    protected function contentRepository()
    {
        return app()->make(ContentRepository::class);
    }

}