<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    use SoftDeletingScope

    protected $dates = ['deleted_at'];

    public function blocks()
    {
        return $this->hasMany(ContentBlock::class, 'content_id', 'id');
    }
}
