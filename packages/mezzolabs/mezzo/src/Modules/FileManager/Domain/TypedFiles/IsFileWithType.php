<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles;


use App\File;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MezzoLabs\Mezzo\Core\Files\Types\FileType;
use MezzoLabs\Mezzo\Core\Files\Types\UnknownFileType;

/**
 * @property File $file
 * @property integer $file_id
 */
trait IsFileWithType
{
    /**
     * @var string
     */
    protected $fileType = UnknownFileType::class;

    /**
     * @var FileType
     */
    protected $fileTypeObject;

    /**
     * @return FileType
     */
    public function fileType()
    {
        if(!$this->fileTypeObject)
            $this->fileTypeObject = FileType::makeByClass($this->fileType);

        return $this->fileTypeObject;
    }

    /**
     * The relation to the saved file.
     *
     * @return BelongsTo
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

}