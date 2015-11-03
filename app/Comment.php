<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoComment;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Comments
 *
 */
class Comment extends MezzoComment
{

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
