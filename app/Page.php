<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }
}
