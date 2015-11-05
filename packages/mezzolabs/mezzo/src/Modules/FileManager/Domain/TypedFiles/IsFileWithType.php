<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles;


use App\File;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MezzoLabs\Mezzo\Core\Files\Types\FileType;
use MezzoLabs\Mezzo\Core\Files\Types\UnknownFileType;

/**
 * @property File $file
 */
trait IsFileWithType
{
    /**
     * @var string
     */
    protected $fileTypeClass = UnknownFileType::class;

    /**
     * @var FileType
     */
    protected $fileType;

    /**
     * @return FileType
     */
    public function fileType()
    {
        if(!$this->fileType)
            $this->fileType = FileType::makeByClass($this->fileTypeClass);

        return $this->fileType;
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