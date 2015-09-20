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

    public function plannedTutorials(){
        return $this->belongsToMany(Tutorial::class, 'planned_tutorial_category');
    }

    public function mainTutorials(){
        return $this->hasMany(Tutorial::class, 'main_category');
    }



}
