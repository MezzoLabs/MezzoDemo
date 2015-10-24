<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoPermission;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;

class Permission extends MezzoPermission
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
