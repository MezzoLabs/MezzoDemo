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

    /**
     * Set of rules that will be validated in resource requests.
     *
     * @var array
     */
    protected $rules = [
        'slug' => "unique",
        'label' => "required|unique_with:categories, category_group_id",
        '_lft' => "",
        '_rgt' => "",
        'parent_id' => ""
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "label",
        "slug",
        "parent_id",
        "category_group_id"
    ];

    public function tutorials()
    {
        return $this->belongsToMany(Tutorial::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function group()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id', 'id');
    }

    public function scopeInGroup($query, $groupName)
    {
        $group = CategoryGroup::findByIdentifierOrFail($groupName);

        return $query->where('category_group_id', '=', $group->id);
    }

}
