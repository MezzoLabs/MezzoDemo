<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoCategoryGroup;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Modules\Categories\Domain\Repositories\CategoryGroupRepository;
use MezzoLabs\Mezzo\Modules\Categories\Domain\Repositories\CategoryRepository;
use MezzoLabs\Mezzo\Modules\Categories\Exceptions\CannotFindCategoryGroupException;

/**
 * Class CategoryGroup
 * @package App
 *
 * @property EloquentCollection|null $models
 */
class CategoryGroup extends MezzoCategoryGroup implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'label',
        'save_to' => 'slug',
    ];

    /**
     * @param $group
     * @return \App\CategoryGroup|null
     * @throws InvalidArgumentException
     */
    public static function findByIdentifier($group)
    {
        return static::repository()->findByIdentifier($group);
    }

    /**
     * @return CategoryGroupRepository
     */
    protected static function repository(){
        return new CategoryGroupRepository();
    }

    /**
     * @param $category
     * @return \App\CategoryGroup
     * @throws CannotFindCategoryGroupException
     * @throws InvalidArgumentException
     */
    public static function findByIdentifierOrFail($group)
    {
        return static::repository()->findByIdentifierOrFail($group);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function models()
    {
        return $this->hasMany(CategoryGroupModel::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * @param array $modelClasses
     * @throws \MezzoLabs\Mezzo\Exceptions\MezzoException
     */
    public function syncModels(array $modelClasses)
    {
        $this->removeAllModels();

        foreach ($modelClasses as $modelClass) {
            CategoryGroupModel::createFromClass($this, $modelClass);
        }
    }

    protected function removeAllModels()
    {
        if (!$this->models) return;

        $this->models->each(function (CategoryGroupModel $categoryGroupModel) {
            $categoryGroupModel->delete();
        });
    }

    /**
     * @param $className
     * @return bool
     */
    public function hasModel($className)
    {
        return $this->modelClasses()->contains($className);
    }

    /**
     * @return Collection
     */
    public function modelClasses()
    {
        $classes = new Collection();

        if (!$this->models) return $classes;

        $this->models->each(function (CategoryGroupModel $model) use ($classes) {
            $classes->push($model->model);
        });

        return $classes;
    }

    public function attachCategory($category)
    {
        $category = \App\Category::findByIdentifierOrFail($category);
        $category->category_group_id = $this->id;
    }

    /**
     * @param $label
     * @return bool|mixed
     */
    public function createCategory($label, $parent = null)
    {
        return $this->categoryRepository()->createInGroup($this, $label, $parent);
    }

    /**
     * @return CategoryRepository
     */
    protected static function categoryRepository(){
        return new CategoryRepository();
    }
}
