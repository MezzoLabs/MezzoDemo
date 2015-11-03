<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function images()
    {
        return $this->hasMany(ImageFile::class);
    }
}
