<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Domain\Traits;


use App\File;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait IsFileWithType
{
    public function fileType()
    {

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