<?php

namespace App;

use App\Mezzo\Generated\ModelTraits\MezzoTutorial;
use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;


class Image extends Model
{
    public function tutorial(){
        return $this->belongsTo('App\Tutorial');
    }



}
