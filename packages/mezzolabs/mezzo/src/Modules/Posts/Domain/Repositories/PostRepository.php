<?php


namespace MezzoLabs\Mezzo\Modules\Posts\Domain\Repositories;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories\ContentRepository;

class PostRepository extends ModelRepository
{


    /**
     * @return ContentRepository
     */
    protected function contentRepository()
    {
        return app()->make(ContentRepository::class);
    }

}