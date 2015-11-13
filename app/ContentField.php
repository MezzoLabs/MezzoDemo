<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoContentField;

class ContentField extends MezzoContentField
{
    public function block()
    {
        return $this->belongsTo(ContentBlock::class, 'content_block_id', 'id');
    }
}
