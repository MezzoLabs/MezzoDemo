<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Http\Requests;


use App\File;
use MezzoLabs\Mezzo\Core\Helpers\StringHelper;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\DisksManager;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\Repositories\FileRepository;
use MezzoLabs\Mezzo\Modules\FileManager\Exceptions\FileNameNotUniqueException;

class UpdateFileRequest extends UpdateResourceRequest
{
    public $model = File::class;

    /**
     * Validate the class instance.
     *
     * @return void
     */
    public function validate()
    {
        parent::validate();

        $this->validateUniqueInFolder();
    }

    protected function validateUniqueInFolder()
    {
        $drives = DisksManager::make();
        $old = $this->getOldFile();

        $shortPathFrom = $old->shortPath(true);
        $shortPathTo = StringHelper::path($this->value('folder'), $this->value('filename'));

        if ($shortPathFrom == $shortPathTo)
            return true;

        if ($drives->exists($this->value('disk'), $shortPathTo)) {
            throw new FileNameNotUniqueException($this->value('folder'), $this->value('filename'));
        }

        return true;
    }


    /**
     * @return \App\File
     */
    protected function getOldFile()
    {
        return $this->fileRepository()->find($this->id());
    }

    /**
     * @return FileRepository
     * @throws \MezzoLabs\Mezzo\Exceptions\RepositoryException
     */
    protected function fileRepository()
    {
        return FileRepository::makeRepository();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filename' => 'required|between:3,255',
            'folder' => 'required|between:1,255'
        ];
    }


}