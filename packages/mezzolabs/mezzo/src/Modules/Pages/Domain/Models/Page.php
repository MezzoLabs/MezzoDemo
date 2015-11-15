<?php


namespace MezzoLabs\Mezzo\Modules\Pages\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoPage;
use Cviebrock\EloquentSluggable\SluggableTrait;

abstract class Page extends MezzoPage
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
    ];
}