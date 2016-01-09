<?php

namespace App\Magazine\Events\Http\ApiControllers;


use App\LockableResources\HandlesLockableApiResources;
use MezzoLabs\Mezzo\Http\Controllers\GenericApiResourceController;

class EventApiController extends GenericApiResourceController
{
    use HandlesLockableApiResources;

}