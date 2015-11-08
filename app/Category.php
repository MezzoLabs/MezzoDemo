<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoCategory;

class Category extends MezzoCategory
{
    public function group(){
        return $this->belongsTo(CategoryGroup::class, 'category_group_id');
    }
}
