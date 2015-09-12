<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Core\Traits\MezzoModel;

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
    use MezzoModel;

    function comments(){
        return $this->hasMany('Comment');
    }
}
