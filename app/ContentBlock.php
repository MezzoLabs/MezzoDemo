<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoContentBlock;

class ContentBlock extends MezzoContentBlock
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
