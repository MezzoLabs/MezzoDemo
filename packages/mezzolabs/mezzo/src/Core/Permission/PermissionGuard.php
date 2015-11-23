<?php


namespace MezzoLabs\Mezzo\Core\Permission;

use Illuminate\Auth\Guard as AuthGuard;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoModel;

class PermissionGuard
{
    /**
     * @var AuthGuard
     */
    protected $authGuard;

    /**
     * @param AuthGuard $authGuard
     */
    public function __construct(AuthGuard $authGuard)
    {
        $this->authGuard = $authGuard;
    }

    /**
     * Get the logged in user.
     *
     * @return \App\User|null
     */
    public function user()
    {
        return $this->authGuard->user();
    }

    /**
     * Check if there is a logged in user.
     *
     * @return bool
     */
    public function loggedIn()
    {
        return $this->user() != null;
    }

    public function allowsCreate(MezzoModel $model, \App\User $user = null)
    {
        return $this->allowsModelAccess($model, 'create', $user);
    }

    public function allowsShow(MezzoModel $model, \App\User $user = null)
    {
        return $this->allowsModelAccess($model, 'show', $user);
    }


    public function allowsEdit(MezzoModel $model, \App\User $user = null)
    {
        return $this->allowsModelAccess($model, 'edit', $user);
    }

    public function allowsDelete(MezzoModel $model, \App\User $user = null)
    {
        return $this->allowsModelAccess($model, 'delete', $user);
    }

    public function allowsCockpit(\App\User $user = null)
    {
        return $this->hasPermission('cockpit', $user);
    }

    protected function allowsModelAccess(MezzoModel $model, $level = 'show', \App\User $user = null)
    {
        //TODO: Change this as soon as marc accepts my JWT
        return true;
        if (!$user) $user = $this->user();

        $accessAll = $this->permissionKey($level, $model);
        $accessOwn = $this->permissionKey($level . '_own', $model);

        if ($this->hasPermission($accessAll))
            return true;

        if ($this->hasPermission($accessOwn) && $model->isOwnedByUser($user))
            return true;

        return false;
    }

    /**
     * @param $name
     * @param MezzoModel|null $model
     * @return string
     */
    protected function permissionKey($name, MezzoModel $model = null)
    {
        if ($model)
            return strtolower(class_basename($model)) . '.' . strtolower($name);

        return strtolower($name);
    }

    public function hasPermission($permission, \App\User $user = null)
    {
        if (!$user) $user = $this->user();

        return $user->hasPermission($permission);
    }
}