<?php


namespace MezzoLabs\Mezzo\Modules\Categories\Domain\Repositories;


use App\Category as AppCategory;
use App\Category;
use App\CategoryGroup as AppCategoryGroup;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Modules\Categories\Exceptions\CannotFindCategoryException;

class CategoryRepository extends ModelRepository
{
    /**
     * @param $groupIdentifier
     * @param $label
     * @param null $parentIdentifier
     * @return Category
     * @throws CannotFindCategoryException
     * @throws \MezzoLabs\Mezzo\Modules\Categories\Exceptions\CannotFindCategoryGroupException
     */
    public function createInGroup($groupIdentifier, $label, $parentIdentifier = null)
    {
        $group = $this->groupRepository()->findByIdentifierOrFail($groupIdentifier);

        $parent = ($parentIdentifier) ?
            $this->findByIdentifierOrFail($parentIdentifier, $group)
            : null;

        $data = [
            'label' => $label
        ];

        return $this->createCategory($data, $group, $parent);
    }

    /**
     * @return CategoryGroupRepository
     */
    protected function groupRepository()
    {
        return new CategoryGroupRepository();
    }

    /**
     * @param $category
     * @param null $group
     * @return Category
     * @throws CannotFindCategoryException
     * @throws InvalidArgumentException
     */
    public function findByIdentifierOrFail($category, $group = null)
    {
        $found = static::findByIdentifier($category, $group);

        if (!$found)
            throw new CannotFindCategoryException($category);

        return $found;
    }

    /**
     * @param $category
     * @param null $group
     * @return AppCategory|null
     * @throws InvalidArgumentException
     */
    public function findByIdentifier($category, $group = null)
    {
        if ($category instanceof Category)
            return $category;

        if (is_numeric($category))
            return $this->find($category);

        if (is_string($category) && $group) {
            return $this->findByGroupAndSlug($group, $category);
        }

        throw new InvalidArgumentException($category);
    }

    /**
     * @param $groupIdentifier
     * @param $categorySlug
     * @return AppCategory|null|static
     * @throws InvalidArgumentException
     */
    public function findByGroupAndSlug($groupIdentifier, $categorySlug)
    {
        $group = $this->groupRepository()->findByIdentifier($groupIdentifier);

        if (!$group) return null;

        $result = $this->query()->where('category_group_id', '=', $group->id)
            ->where('slug', '=', str_slug($categorySlug))->first();

        return $result;
    }

    /**
     * @param array $data
     * @param AppCategoryGroup $group
     * @param AppCategory $parent
     * @return AppCategory
     * @throws CannotFindCategoryException
     *
     */
    public function createCategory(array $data, AppCategoryGroup $group, AppCategory $parent = null)
    {
        $category = new AppCategory();

        $data['category_group_id'] = $group->id;

        unset($data['parent_id']);

        $category->fill($data);

        if ($parent) {
            $category->appendTo($parent);
        } else
            $category->makeRoot();

        $category->save();

        return $category;
    }

    public function create(array $data)
    {
        $group = $this->groupRepository()->findByIdentifierOrFail($data['category_group_id']);

        $parent = ($data['parent_id']) ?
            $this->findByIdentifierOrFail($data['parent_id'], $group)
            : null;

        return $this->createCategory($data, $group, $parent);
    }

    /**
     * @return AppCategory
     */
    protected function modelInstance()
    {
        return parent::modelInstance();
    }


}