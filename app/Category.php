<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoCategory;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Category extends MezzoCategory implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'label',
        'save_to'    => 'slug',
    ];

    protected $fillable = [
        'label'
    ];

    public function group(){
        return $this->belongsTo(CategoryGroup::class, 'category_group_id');
    }
}
