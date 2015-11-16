<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;

class ContentBlockRepository extends ModelRepository
{
    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $data = new Collection($data);
        $fieldValues = $data->get('fields', []);
        $optionsArray = $data->get('options', []);

        $attributesData = new Collection($data);
        $attributesData->forget(['fields']);
        $attributesData->put('options', json_encode($optionsArray));

        $block = parent::create($attributesData->toArray());

        foreach ($fieldValues as $name => $value) {
            $this->createField($block, $name, $value);
        }


    }

    /**
     * @param \App\ContentBlock $block
     * @param $name
     * @param $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function createField(\App\ContentBlock $block, $name, $value)
    {
        $data = [
            'content_block_id' => $block->id,
            'name' => $name,
            'value' => $value
        ];

        return $this->fieldRepository()->create($data);
    }

    protected function fieldRepository()
    {
        return app()->make(ContentFieldRepository::class);
    }

    public function updateRecentText($content_id, $prepend = "")
    {

    }

}