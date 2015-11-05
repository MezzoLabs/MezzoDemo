<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\FileUpload;

use Illuminate\Http\Request as IlluminateRequest;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Files\File;
use MezzoLabs\Mezzo\Core\Files\StorageFactory;
use MezzoLabs\Mezzo\Core\Validation\Validator;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\Repositories\FileRepository;
use MezzoLabs\Mezzo\Modules\FileManager\FileUpload\Exceptions\FileUploadException;
use MezzoLabs\Mezzo\Modules\FileManager\FileUpload\Exceptions\MaximumFileSizeExceededException;
use MezzoLabs\Mezzo\Modules\FileManager\FileUpload\Exceptions\MimeTypeNotAllowed;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
     * @var \Illuminate\Validation\Validator
     */
    protected $lastValidation;


    /**
     * Creates the file uploader singleton.
     * This service will help you to upload a file to the file system of the server and register it in the database.
     */
    public function __construct()
    {

    }

    /**
     * Upload a image.
     *
     * @param array $metaData
     * @param UploadedFile $file
     * @return bool
     * @throws FileUploadException
     * @throws MaximumFileSizeExceededException
     * @throws MimeTypeNotAllowed
     */
    public function upload(array $metaData, UploadedFile $file)
    {
        $fileValidation = $this->validateFile($file);
        if (!$fileValidation)
            throw new FileUploadException('File validation failed.');

        $metaData = new Collection($metaData);
        $data = new Collection();

        $data->put('extension', $this->extension($file));
        $data->put('folder', $metaData->get('folder', '/'));
        $data->put('filename', $this->uniqueFileName($file, $data['folder']));

        $title = $metaData->get('title', "");
        if (empty($title))
            $title = File::removeExtension($data->get('filename'));

        $data->put('title', $title);
        $data->put('disk', 'local');
        $data->put('info', $this->fileInfoJson($file));

        if (!$this->validateData($data))
            throw new FileUploadException('Validation failed.');

        $fileSaved = $this->moveFile($file, $data->get('folder'), $data->get('filename'));

        $databaseSaved = $this->repository()->create($data->toArray());

        return $fileSaved && $databaseSaved;
    }

    /**
     * Upload the file in the current request.
     *
     * Read the request and upload the file.
     *
     * @param IlluminateRequest $request
     * @return bool
     */
    public function uploadInput(IlluminateRequest $request)
    {
        $data = [
            'title' => $request->get('title', ''),
            'folder' => $request->get('folder', 'default'),
        ];

        return $this->upload($data, $request->file('file'));
    }

    /**
     * Validate the meta data that will be saved in the database.
     *
     * @param Collection $data
     * @return bool
     */
    protected function validateData(Collection $data)
    {
        $rules = app(\App\File::class)->getRules();

        $validation = Validator::make($data->toArray(), $rules);

        $this->lastValidation = $validation;

        return $validation->passes();
    }

    /**
     * Create a JSON string with all the "unimportant" file infos.
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function fileInfoJson(UploadedFile $file)
    {
        $info = new Collection();

        $info->put('size', $file->getClientSize());
        $info->put('originalName', $file->getClientOriginalName());

        return $info->toJson();
    }

    /**
     * Move the uploaded file to its destination
     *
     * @param UploadedFile $file
     * @param $directory
     * @param $fileName
     * @return \Symfony\Component\HttpFoundation\File\File
     */
    protected function moveFile(UploadedFile $file, $directory, $fileName)
    {
        $storageDirectory = storage_path('mezzo/upload/' . $directory);
        $saved = $file->move($storageDirectory, $fileName);
        return $saved;
    }


    /**
     * Get the instance for the local file system.
     *
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected function localFileSystem()
    {
        return StorageFactory::local();
    }

    /**
     * Validate the file size and the mimetype.
     *
     * @param UploadedFile $file
     * @return bool
     * @throws MaximumFileSizeExceededException
     * @throws MimeTypeNotAllowed
     */
    public function validateFile(UploadedFile $file)
    {
        if ($file->getClientSize() > $this->maximumFileSize())
            throw new MaximumFileSizeExceededException();

        if (!$this->mimeTypeAllowed($file->getClientMimeType()))
            throw new MimeTypeNotAllowed();

        return true;
    }

    protected function extension(UploadedFile $file)
    {
        $guessed = $file->guessClientExtension();
        if ($guessed)
            return $guessed;

        return $file->getClientOriginalExtension();
    }

    public function maximumFileSize()
    {
        return 3 * 1000 * 1000;
    }

    /**
     * Get a file name that is formatted and unique in its folder.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string
     */
    protected function uniqueFileName(UploadedFile $file, $folder)
    {
        $formatted = $this->formattedFileName($file);
        return $this->repository()->findUniqueFileName($formatted, $folder);
    }


    /**
     * Check if the mimeType is allowed.
     *
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
     * Format the filename (name + extension) with snake case.
     *
     * @param UploadedFile $file
     * @return string
     * @throws FileUploadException
     */
    protected function formattedFileName(UploadedFile $file)
    {
        $extension = $this->extension($file);

        $baseName = str_slug(File::removeExtension($file->getClientOriginalName()), '_');

        return $baseName . '.' . $extension;
    }

    /**
     * Get the file repository instance.
     *
     * @return FileRepository
     * @throws \MezzoLabs\Mezzo\Exceptions\RepositoryException
     */
    protected function repository()
    {
        return FileRepository::makeRepository();
    }
}