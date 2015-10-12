<?php

namespace App;

use App\Mezzo\Generated\ModelTraits\MezzoTutorial;
use Illuminate\Database\Eloquent\Model;
use \MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;


/**
 * App\Tutorial
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $creator
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Tutorial whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tutorial whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tutorial whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tutorial whereCreator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tutorial whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tutorial whereUpdatedAt($value)
 */
class Tutorial extends Model
{
    use MezzoTutorial;

    public function mainImage()
    {
        return $this->hasOne('App\Image');
    }

    public function parent()
    {
        return $this->hasOne('App\Tutorial', 'parent');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function plannedCategories()
    {
        return $this->belongsToMany(Category::class, 'planned_tutorial_category');
    }

    public function mainCategory()
    {
        return $this->belongsTo('App\Category', 'main_category');
    }


}
