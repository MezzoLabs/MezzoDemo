<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryGroupModel extends Model
{
    public function group(){
        return $this->belongsTo(CategoryGroup::class, 'category_group_id');
    }
}
