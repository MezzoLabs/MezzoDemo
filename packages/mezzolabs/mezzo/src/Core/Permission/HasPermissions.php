<?php

namespace MezzoLabs\Mezzo\Core\Permission;


use App\Permission;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Modules\User\Domain\Repositories\PermissionRepository;
use MezzoLabs\Mezzo\Modules\User\Domain\Repositories\RoleRepository;
use MezzoLabs\Mezzo\Modules\User\Domain\Repositories\UserRepository;

/**
 * Class HasPermissions
 * @package MezzoLabs\Mezzo\Core\Permission
 *
 * @property Collection $roles
 * @property Collection $permissions
 */
trait HasPermissions
{

    private $permissions;

    /**
     * @return Collection
     * @throws \MezzoLabs\Mezzo\Exceptions\RepositoryException
     */
    public function permissions()
    {
        if (!$this->permissions) {
            $this->permissions = UserRepository::makeRepository()->permissions($this);
        }

        return $this->permissions;
    }

    public function attachRole($role)
    {
        UserRepository::instance()->attachRole($this, $role);
    }

    public function detachRole($role)
    {
        UserRepository::instance()->detachRole($this, $role);
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasPermission($key)
    {
        if ($key instanceof \App\Permission)
            $key = $key->key();

        $hasPermission = false;
        $this->permissions()->each(function (Permission $permission) use ($key, &$hasPermission) {
            if ($permission->equals($key)) {
                $hasPermission = true;
                return false;
            }
        });

        return $hasPermission;
    }

    protected function roleRepository()
    {
        return app()->make(RoleRepository::class);
    }

    protected function permissionRepository()
    {
        return app()->make(PermissionRepository::class);
    }



}