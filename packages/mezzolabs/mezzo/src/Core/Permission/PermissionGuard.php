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

    public function canEdit(MezzoModel $model, \App\User $user = null)
    {
        if (!$user) $user = $this->user();


    }

    protected function permissionKey($name, $model = null)
    {

    }

    public function hasPermission($permission, \App\User $user = null)
    {
        if (!$user) $user = $this->user();

        $user->hasPermission($permission);
    }
}