<?php


namespace MezzoLabs\Mezzo\Modules\Posts\Domain\Repositories;


use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Exceptions\RepositoryException;
use packages\mezzolabs\mezzo\src\Modules\Contents\Domain\Repositories\IsRepositoryWithContentBlocks;

class PostRepository extends ModelRepository
{
    use IsRepositoryWithContentBlocks;

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $data = $this->replaceBlocksWithContentId($data);

        return parent::create($data->toArray());
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return MezzoModel
     * @throws RepositoryException
     */
    public function update(array $data, $id, $attribute = "id")
    {
        if (isset($data['content'])) {
            $data = $this->replaceBlocksWithContentId($data)->toArray();
        }

        return parent::update($data, $id, $attribute);
    }


}