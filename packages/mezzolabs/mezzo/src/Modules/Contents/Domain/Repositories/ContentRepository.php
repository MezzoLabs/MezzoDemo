<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;

class ContentRepository extends ModelRepository
{
    /**
     * @param array $blocksData
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createWithBlocks(array $blocksData)
    {
        $content = parent::create([]);

        foreach ($blocksData as &$blockData) {
            $blockData['content_id'] = $content->id;
            $this->blockRepository()->create($blockData);
        }

        return $content;
    }

    /**
     * Get an instance of the repository that handles the content blocks.
     *
     * @return ContentBlockRepository
     */
    protected function blockRepository()
    {
        return app()->make(ContentBlockRepository::class);
    }
}