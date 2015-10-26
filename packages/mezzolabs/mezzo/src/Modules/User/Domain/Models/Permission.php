<?php


namespace MezzoLabs\Mezzo\Modules\User\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoPermission;
use App\Role as AppRole;

abstract class Permission extends MezzoPermission
{
    public function roles()
    {
        return $this->belongsToMany(AppRole::class);
    }
}