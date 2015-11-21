<?php


namespace MezzoLabs\Mezzo\Modules\Posts\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoPost;
use App\User;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

abstract class Post extends MezzoPost implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
    ];


}