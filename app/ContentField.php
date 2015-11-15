<?php

namespace App;

use MezzoLabs\Mezzo\Modules\Contents\Domain\Models\ContentField as ContentModuleContentField;

class ContentField extends ContentModuleContentField
{
    public function block()
    {
        return $this->belongsTo(ContentBlock::class, 'content_block_id', 'id');
    }
}
