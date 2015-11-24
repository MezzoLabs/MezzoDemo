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

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function scopeInGroup($query, $groupName)
    {
        $group = CategoryGroup::findByIdentifierOrFail($groupName);

        return $query->where('category_group_id', '=', $group->id);
    }

}
