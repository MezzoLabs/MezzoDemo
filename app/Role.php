<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoRole;
use MezzoLabs\Mezzo\Core\Annotations as Mezzo;

class Role extends MezzoRole
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
