<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;

/**
 * App\Comments
 *
 */
class Comment extends Model
{
    public function tutorial(){
        $this->belongsTo(Tutorial::class);
    }
}
