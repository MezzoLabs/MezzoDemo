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
        $fields = $data->get('fields', []);
        $options = $data->get('options' []);

        $attributesData = new Collection($data);
        $attributesData->forget(['optinos', 'fields']);

        $block = parent::create($data);

        mezzo_dd($block);
    }

}