<?php


namespace App;


use App\Mezzo\Generated\ModelParents\MezzoLikedCategory;
use App\Repositories\LikedCategoriesRepository;

class LikedCategory extends MezzoLikedCategory
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relevance() : float
    {
        return $this->base_value * 2 + $this->add_value;
    }

    /**
     * @return LikedCategoriesRepository
     */
    public static function repository()
    {
        return app(LikedCategoriesRepository::class);
    }
}