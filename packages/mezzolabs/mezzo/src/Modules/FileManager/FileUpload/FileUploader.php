<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\FileUpload;

use Illuminate\Http\Request as IlluminateRequest;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\Repositories\FileRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
     * Creates the file uploader singleton.
     * This service will help you to upload a file to the file system of the server and register it in the database.
     */
    public function __construct()
    {

    }

    public function upload(array $uploadData, UploadedFile $file)
    {
        $fileValidation = $this->validateFile($file);
        if (!$fileValidation)
            throw new FileUploadException('File validation failed.');

        $uploadData = new Collection($uploadData);
        $data = new Collection();

        $data->put('extension', $this->extension($file));
        $data->put('folder', $uploadData->get('folder', '/'));
        $data->put('filename', $this->filename($file, $data['folder']));

        $title = $uploadData->get('title', "");
        if (empty($title))
            $title = $data->get('filename');

        $data->put('title', $title);

        $this->moveFile($file, $data->get('folder') . $data->get('filename'));


    }

    protected function moveFile(UploadedFile $file, $destination)
    {
    }


    public function validateFile(UploadedFile $file)
    {
        if ($file->getClientSize() > $this->maximumFileSize())
            throw new MaximumFileSizeExceededException();

        if (!$this->mimeTypeAllowed($file->getClientMimeType()))
            throw new MimeTypeNotAllowed();

        return true;
    }

    /**
     * Read the request and upload the file.
     *
     * @param IlluminateRequest $request
     */
    public function uploadInput(IlluminateRequest $request)
    {
        $data = [
            'title' => $request->get('title', ''),
            'folder' => $request->get('folder', '/'),
        ];

        return $this->upload($data, $request->file('file'));
    }

    protected function extension(UploadedFile $file)
    {
        return $file->guessClientExtension();
    }

    public function maximumFileSize()
    {
        return 3 * 1000 * 1000;
    }

    /**
     * @param UploadedFile $file
     * @param string $folder
     */
    protected function fileName(UploadedFile $file, $folder)
    {
        $baseFileName = str_slug($file->getClientOriginalName(), '_');
        return $this->repository()->findUniqueFileName($baseFileName, $folder);
    }


    /**
     * @param string $mimeType
     * @return bool
     */
    public function mimeTypeAllowed($mimeType)
    {
        return in_array($mimeType, [
            'jpg', 'jpeg', 'text/markdown', 'txt'
        ]);
    }

    /**
     * @return FileRepository
     * @throws \MezzoLabs\Mezzo\Exceptions\RepositoryException
     */
    protected function repository()
    {
        return FileRepository::makeRepository();
    }
}