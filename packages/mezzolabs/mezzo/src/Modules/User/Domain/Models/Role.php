<?php


namespace MezzoLabs\Mezzo\Modules\User\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoRole;
use App\Permission;
use App\User;

abstract class Role extends MezzoRole
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}