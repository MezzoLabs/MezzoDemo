<?php

namespace App;

use App\Mezzo\Generated\ModelTraits\MezzoTutorial;
use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;


class Category extends Model
{
    public function tutorials(){
        return $this->belongsToMany(Tutorial::class);
    }



}
