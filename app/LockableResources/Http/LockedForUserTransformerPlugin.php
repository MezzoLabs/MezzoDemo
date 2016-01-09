<?php


namespace App\LockableResources\Http;


use App\LockableResources\LockableResource;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoModel;
use MezzoLabs\Mezzo\Http\Transformers\Plugins\TransformerPlugin;

class LockedForUserTransformerPlugin extends TransformerPlugin
{

    /**
     * @param MezzoModel $model
     * @return array
     */
    public function transform(MezzoModel $model) : array
    {
        if (!$model instanceof LockableResource)
            return [];

        $locked_by = null;
        if ($model->isLocked()) $locked_by = $model->lockedBy->email;

        return [
            '_locked_for_user' => $model->isLockedForUser(),
            '_locked_by' => $locked_by
        ];
    }
}