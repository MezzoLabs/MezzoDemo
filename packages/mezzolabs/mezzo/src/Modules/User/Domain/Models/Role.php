<?php


namespace MezzoLabs\Mezzo\Modules\User\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoRole;
use App\Permission as AppPermission;
use App\User as AppUser;

abstract class Role extends MezzoRole
{
    public function users()
    {
        return $this->belongsToMany(AppUser::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(AppPermission::class);
    }
}