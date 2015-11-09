<?php

namespace App;

use MezzoLabs\Mezzo\Modules\Categories\Models\Category as BaseCategory;

/**
 * Class Category
 * @package App
 *
 * @property CategoryGroup $group
 */
class Category extends BaseCategory
{

    public function group(){
        return $this->belongsTo(CategoryGroup::class, 'category_group_id');
    }

    public function tutorials()
    {
        return $this->belongsToMany(Tutorial::class);
    }
}
