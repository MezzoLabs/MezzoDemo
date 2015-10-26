<?php


namespace MezzoLabs\Mezzo\Modules\User\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoPermission;

abstract class Permission extends MezzoPermission
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}