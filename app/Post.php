<?php

namespace App;

use App\LockableResources\CanBeLocked;
use App\LockableResources\LockableResource;
use App\Magazine\Relevance\CanBeSortedByRelevance;
use Illuminate\Database\Eloquent\SoftDeletes;
use MezzoLabs\Mezzo\Modules\Posts\Domain\Models\Post as ModulePostModel;

class Post extends ModulePostModel implements LockableResource
{
    use CanBeSortedByRelevance;
    use CanBeLocked;
    use SoftDeletes;

    public $searchable = ['title', 'teaser'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function main_image()
    {
        return $this->belongsTo(ImageFile::class, 'main_image_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \App\User|null
     */
    public function lockedBy()
    {
        return $this->belongsTo(User::class, 'locked_by_id', 'id');
    }
}
