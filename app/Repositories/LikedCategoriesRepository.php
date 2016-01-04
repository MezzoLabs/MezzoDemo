<?php


namespace App\Repositories;


use App\Category;
use App\LikedCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikedCategoriesRepository
{

    /**
     * @param \App\User $user
     * @return mixed
     */
    public function unsetBaseValues(\App\User $user)
    {
        return DB::table('liked_categories')
            ->where('user_id', $user->id)
            ->update(array('base_value' => 0));
    }

    /**
     * @param Category $category
     * @param \App\User $user
     * @return LikedCategory
     */
    public function like(\App\Category $category, \App\User $user = null)
    {
        if (empty($user))
            $user = Auth::user();

        $found = $this->find($category, $user);

        if ($found) {
            return $this->update($found, 100);
        }

        return $this->create($category, $user, 100);
    }

    /**
     * @param Category $category
     * @param \App\User $user
     * @param int $base_value
     * @param int $add_value
     * @return LikedCategory
     */
    public function create(\App\Category $category, \App\User $user, $base_value = 100, $add_value = 0)
    {
        $new = new LikedCategory();
        $new->user_id = $user->id;
        $new->category_name = str_slug($category->label);
        $new->base_value = $base_value;
        $new->add_value = $add_value;
        $new->save();

        return $new;
    }

    /**
     * @param LikedCategory $likedCategory
     * @param null $base_value
     * @param null $add_value
     * @return LikedCategory
     */
    public function update(LikedCategory $likedCategory, $base_value = null, $add_value = null)
    {
        if ($base_value != null)
            $likedCategory->base_value = $base_value;

        if ($add_value != null)
            $likedCategory->add_value = $add_value;

        $likedCategory->touch();
        $likedCategory->save();

        return $likedCategory;
    }

    /**
     * @param int $amount
     * @param Category $category
     * @param \App\User|null $user
     * @return LikedCategory
     */
    public function addValue(int $amount, \App\Category $category, \App\User $user = null)
    {
        if (empty($user))
            $user = Auth::user();

        $found = $this->find($category, $user);

        if ($found)
            return $this->update($found, null, $found->add_value += $amount);

        return $this->create($category, $user, 0, $amount);

    }

    /**
     * @param \App\User $user
     * @param Category $category
     * @return LikedCategory|null
     */
    public function find(\App\Category $category, \App\User $user)
    {
        return LikedCategory::where('category_name', '=', str_slug($category->label))
            ->where('user_id', '=', $user->id)->first();
    }
}