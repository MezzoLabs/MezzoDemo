<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentBlock extends Model
{
    public function fields()
    {
        return $this->hasMany(ContentField::class, 'content_block_id', 'id');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }
}
