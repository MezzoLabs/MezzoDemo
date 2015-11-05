<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Domain\Repositories;


use App\File;
use App\ImageFile;
use MezzoLabs\Mezzo\Core\Files\Types\FileType;
use MezzoLabs\Mezzo\Core\Files\Types\ImageFileType;
use MezzoLabs\Mezzo\Core\Helpers\Slug;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\FileTypesMapper;

class FileRepository extends ModelRepository
{
    public $fileTypes = [
        ImageFileType::class => ImageFile::class
    ];

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

    /**
     * @return File
     */
    protected function fileInstance()
    {
        return parent::modelInstance();
    }

    protected function createTypedFile(File $newFile)
    {
        $fileType = $newFile->fileType();

        $newTypedFile = $this->typedFileInstance($fileType);


    }

    protected function typedFileInstance(FileType $fileType)
    {
        mezzo()->make(FileTypesMapper::class);


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
     * @param $folder
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function filesInFolder($folder, $columns = ['*'])
    {
        return $this->query()->where('folder', '=', $folder)->get($columns);
    }


}