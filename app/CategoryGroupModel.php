<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoCategoryGroupModel;
use Illuminate\Database\Eloquent\Model;
use MezzoLabs\Mezzo\Exceptions\MezzoException;

class CategoryGroupModel extends MezzoCategoryGroupModel
{
    /**
     * @param CategoryGroup $group
     * @param $modelClass
     * @return static
     * @throws MezzoException
     */
    public static function createFromClass(CategoryGroup $group, $modelClass)
    {
        if(!class_exists($modelClass))
            throw new MezzoException($modelClass . ' is not a valid class.');

        if(!is_subclass_of($modelClass, Model::class))
            throw new MezzoException($modelClass . ' does not extend eloquent.');

        return static::create([
            'category_group_id' => $group->id,
            'model' => $modelClass
        ]);

    }

    public function group()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id');
    }
}
