<?php


namespace MezzoLabs\Mezzo\Modules\Contents\Domain\Repositories;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;

class ContentFieldRepository extends ModelRepository
{
    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return parent::create($data);
    }

}