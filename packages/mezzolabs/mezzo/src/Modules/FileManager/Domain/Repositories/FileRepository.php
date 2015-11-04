<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Domain\Repositories;


use App\File;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;

class FileRepository extends ModelRepository
{
    /**
     * @param $folder
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function filesInFolder($folder, $columns = ['*'])
    {
        return $this->query()->where('folder', '=', $folder)->get($columns);
    }

    public function findUniqueFileName($fileName, $folder)
    {
        $filesInFolder = $this->filesInFolder($folder, ['id', 'title']);

        if (!$filesInFolder)
            return $fileName;

        $filesInFolder->each(function (File $file) {

        });
    }

}