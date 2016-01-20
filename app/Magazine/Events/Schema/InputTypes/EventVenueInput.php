<?php

namespace App\Magazine\Events\Schema\InputTypes;


use MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle;

class EventVenueInput extends RelationInputSingle
{
    protected $htmlAttributes = [
        'mezzo-event-venue' => 1,
        'data-mezzo-select2' => 2
    ];
}