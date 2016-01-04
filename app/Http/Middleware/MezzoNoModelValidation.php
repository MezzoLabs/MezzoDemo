<?php

namespace App\Http\Middleware;

use Closure;
use MezzoLabs\Mezzo\Core\Validation\Validator;

class MezzoNoModelValidation
{

    public function handle($request, Closure $next)
    {
        Validator::setActive(false);

        return $next($request);
    }
}
