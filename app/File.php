<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoFile;

class File extends MezzoFile
{
    public function images()
    {
        return $this->hasMany(ImageFile::class);
    }
}
