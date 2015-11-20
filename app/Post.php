<?php

namespace App;

use MezzoLabs\Mezzo\Modules\Posts\Domain\Models\Post as ModulePostModel;

class Post extends ModulePostModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function main_image()
    {
        return $this->belongsTo(ImageFile::class, 'main_image_id', 'id');
    }
}
