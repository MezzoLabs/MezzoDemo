<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoTutorial;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;
use MezzoLabs\Mezzo\Modules\Categories\Domain\Traits\HasCategories;


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
class Tutorial extends MezzoTutorial
{
    use HasCategories;


    public function parent()
    {
        return $this->hasOne('App\Tutorial', 'id', 'parent_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function foo()
    {
        
    }


}
