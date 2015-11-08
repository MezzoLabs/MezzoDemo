<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryGroup extends Model
{
    public function models(){
        return $this->hasMany(CategoryGroupModel::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }
}
