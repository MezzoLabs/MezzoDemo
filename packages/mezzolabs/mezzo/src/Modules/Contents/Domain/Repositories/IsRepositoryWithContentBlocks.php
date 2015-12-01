<?php

namespace packages\mezzolabs\mezzo\src\Modules\Contents\Domain\Repositories;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories\ContentRepository;

trait IsRepositoryWithContentBlocks
{
    /**
     * @param $data
     * @return Collection
     */
    public function replaceBlocksWithContentId($data)
    {
        $data = new Collection($data);
        $attributesData = new Collection($data);

        $content = $this->contentRepository()->createWithBlocks($data->get('content'));

        $attributesData->forget(['content']);
        $attributesData->put('content_id', $content->id);

        return $attributesData;
    }

    /**
     * @return ContentRepository
     */
    protected function contentRepository()
    {
        return app()->make(ContentRepository::class);
    }
}