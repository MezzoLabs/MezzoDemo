<?php

namespace App;

use MezzoLabs\Mezzo\Modules\Categories\Models\Category as CategoriesModuleCategory;

/**
 * Class Category
 * @package App
 *
 * @property CategoryGroup $group
 */
class Category extends CategoriesModuleCategory
{
    public function tutorials()
    {
        return $this->belongsToMany(Tutorial::class);
    }

}
