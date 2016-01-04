<?php

namespace App\Http\Middleware;

use Closure;
use MezzoLabs\Mezzo\Core\Permission\PermissionGuard;

class MezzoNoPermissionsCheck
{

    public function handle($request, Closure $next)
    {
        PermissionGuard::setActive(false);

        return $next($request);
    }
}
