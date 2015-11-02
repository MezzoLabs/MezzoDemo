<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Comments
 *
 */
class Comment extends Model
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
