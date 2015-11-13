<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentField extends Model
{
    public function block()
    {
        return $this->belongsTo(ContentBlock::class, 'content_block_id', 'id');
    }
}
