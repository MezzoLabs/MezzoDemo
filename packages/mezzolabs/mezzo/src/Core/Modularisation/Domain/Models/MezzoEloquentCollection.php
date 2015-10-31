<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Domain\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class MezzoEloquentCollection
{
    /**
     * @var EloquentCollection
     */
    protected $collection;

    public function __construct(EloquentCollection $collection)
    {
        $this->collection = $collection;
    }

    public function asList()
    {
        if($this->isEmpty())
            return [];

        $first = $this->collection->first();
        $titleAttribute = $this->detectTitleAttribute($first);

        $list = new Collection();
        $this->each(function(MezzoEloquentModel $model) use ($list, $titleAttribute){
            $list->put($model->id, $model->id . ' - ' . $model->getAttribute($titleAttribute));
        });

        return $list;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->collection->isEmpty();
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function each(callable $callback)
    {
        return $this->collection->each($callback);
    }

    /**
     * @return EloquentCollection
     */
    public function eloquentCollection()
    {
        return $this->collection;
    }

    protected function detectTitleAttribute(MezzoEloquentModel $model){
        if($model->getAttribute('title'))
            return 'title';

        if($model->getAttribute('label'))
            return 'label';

        if($model->getAttribute('name'))
            return 'name';

        if($model->getAttribute('key'))
            return 'key';

        if($model->getAttribute('slug'))
            return 'slug';

        foreach($model->getAttributes() as $key => $value){
            if(!in_array($key, $model->getHidden()) && in_array($key, $model->getFillable()))
                return $key;
        }

        return 'id';
    }
}