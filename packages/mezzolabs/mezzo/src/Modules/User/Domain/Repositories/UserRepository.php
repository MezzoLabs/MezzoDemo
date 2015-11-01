<?php


namespace MezzoLabs\Mezzo\Modules\User\Domain\Repositories;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;

class UserRepository extends ModelRepository
{
    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return int
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $data = $this->parseData($data);



        return $this->query()->where($attribute, '=', $id)->update($data);
    }
}