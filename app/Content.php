<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoContent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends MezzoContent
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function blocks()
    {
        return $this->hasMany(ContentBlock::class, 'content_id', 'id');
    }

    public function page()
    {
        return $this->hasOne(Page::class, 'content_id', 'id');
    }
}
