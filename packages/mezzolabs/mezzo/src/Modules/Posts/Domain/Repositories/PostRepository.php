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

        $values = $this->values($data->toArray());


        $modelInstance = $this->modelInstance();

        $model = $modelInstance->create($values->inMainTableOnly()->toArray());


        if (!$model)
            throw new RepositoryException('Cannot create new model of type ' . $this->modelReflection()->className());

        $this->updateRelations($model, $values->inForeignTablesOnly());


        return $model;
    }

}