<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\IsFileWithType;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\TypedFileContract;

class ImageFile extends Model implements TypedFileContract
{
    use IsFileWithType;

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
