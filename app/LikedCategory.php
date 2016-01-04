<?php


namespace App;


use App\Repositories\LikedCategoriesRepository;
use Illuminate\Database\Eloquent\Model;

class LikedCategory extends Model
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
    public function repository() : LikedCategoriesRepository
    {
        return app(LikedCategoriesRepository::class);
    }
}