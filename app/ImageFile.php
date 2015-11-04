<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageFile extends Model
{
    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
