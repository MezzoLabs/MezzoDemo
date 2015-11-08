<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoCategoryGroup;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * Class CategoryGroup
 * @package App
 */
class CategoryGroup extends MezzoCategoryGroup implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'label',
        'save_to'    => 'slug',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function models(){
        return $this->hasMany(CategoryGroupModel::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    /**
     * @param array $modelClasses
     * @throws \MezzoLabs\Mezzo\Exceptions\MezzoException
     */
    public function syncModels(array $modelClasses)
    {
        $this->removeAllModels();
        
        foreach($modelClasses as $modelClass){
            CategoryGroupModel::createFromClass($this, $modelClass);
        }
    }

    /**
     *
     */
    protected function removeAllModels(){
        if(!$this->models) return;

        $this->models->each(function(CategoryGroupModel $categoryGroupModel){
            $categoryGroupModel->delete();
        });
    }
}
