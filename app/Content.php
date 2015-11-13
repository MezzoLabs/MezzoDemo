<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function blocks()
    {
        return $this->hasMany(ContentBlock::class, 'content_id', 'id');
    }
}
