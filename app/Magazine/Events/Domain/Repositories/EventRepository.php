<?php


namespace App\Magazine\Events\Domain\Repositories;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Modules\Addresses\Domain\Repositories\RepositoryWithAddress;

class EventRepository extends ModelRepository
{
    use RepositoryWithAddress;
}