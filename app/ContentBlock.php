<?php

namespace App;

use MezzoLabs\Mezzo\Modules\Contents\Domain\Models\ContentBlock as ContentsModuleContentBlock;

class ContentBlock extends ContentsModuleContentBlock
{
    protected $with = ['fields'];

    public function fields()
    {
        return $this->hasMany(ContentField::class, 'content_block_id', 'id');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }

    public function getLabelAttribute()
    {
        return $this->getType()->title() . ' (' . $this->id . ')';
    }
}
