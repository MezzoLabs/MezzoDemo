<?php
/**
 * Project: MezzoDemo | HasPermissions.php
 * Author: Simon - www.triggerdesign.de
 * Date: 26.10.2015
 * Time: 07:24
 */

namespace MezzoLabs\Mezzo\Core\Permission;


use App\Role;

trait HasPermissions
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function permissions()
    {
        return $this->hasManyThrough(Permission::class, Role::class);
    }


}