<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use MezzoLabs\Mezzo\Modules\Contents\Domain\Models\Content as ContendsModuleContent;

class Content extends ContendsModuleContent
{
    use SoftDeletes;

    protected $with = ['blocks'];

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
