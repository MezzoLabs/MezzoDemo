<?php


namespace MezzoLabs\Mezzo\Modules\Posts\Domain\Repositories;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories\ContentRepository;
use packages\mezzolabs\mezzo\src\Modules\Contents\Domain\Repositories\IsRepositoryWithContentBlocks;

class PostRepository extends ModelRepository
{

    use IsRepositoryWithContentBlocks;


    /**
     * @return ContentRepository
     */
    protected function contentRepository()
    {
        $data = $this->replaceBlocksWithContentId($data);

        return app()->make(ContentRepository::class);
    }

}