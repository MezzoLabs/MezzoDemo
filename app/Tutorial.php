<?php

namespace App;

use App\Mezzo\Generated\ModelTraits\MezzoTutorial;
use Illuminate\Database\Eloquent\Model;
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

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function owner(){
        return $this->hasOne('App\User');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function mainCategory(){
        return $this->belongsTo('App\Category');
    }


}
