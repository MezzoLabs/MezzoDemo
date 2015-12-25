<?php

namespace App;

use MezzoLabs\Mezzo\Modules\Pages\Domain\Models\Page as PagesModulePage;

class Page extends PagesModulePage
{
    public $searchable = ['title', 'teaser'];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }
}
