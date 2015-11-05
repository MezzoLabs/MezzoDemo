<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\Interfaces\TypedFileContract;

class ImageFile extends Model implements TypedFileContract
{


    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
