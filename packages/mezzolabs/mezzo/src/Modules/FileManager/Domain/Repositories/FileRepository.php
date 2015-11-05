<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Domain\Repositories;


use App\File;
use MezzoLabs\Mezzo\Core\Helpers\Slug;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;

class FileRepository extends ModelRepository
{
    /**
     * @param array $data
     * @return File
     */
    public function create(array $data)
    {
        $values = $this->values($data)->inMainTableOnly();

        $newFile = $this->fileInstance();
        $newFile->fill($values->toArray());
        $newFile->save();

        $this->createTypedFile($newFile);
    }

    protected function createTypedFile(File $newFile)
    {
        $fileType = $newFile->fileType();


    }

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
        $filesInFolder = $this->filesInFolder($folder, ['filename']);

        if (!$filesInFolder)
            return $fileName;

        $fileNames = $filesInFolder->lists('filename');

        return Slug::findNext($fileName, $fileNames, [
            'separator' => '_',
            'hasExtension' => true
        ]);
    }

    /**
     * @return File
     */
    protected function fileInstance()
    {
        return parent::modelInstance();
    }

    protected function typedFileInstance()
    {

    }


}