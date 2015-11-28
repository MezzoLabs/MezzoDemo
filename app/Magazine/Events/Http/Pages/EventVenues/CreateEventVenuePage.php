<?php


namespace App\Magazine\Events\Http\Pages\EventVenues;


use MezzoLabs\Mezzo\Cockpit\Pages\Resources\CreateResourcePage;

class CreateEventVenuePage extends CreateResourcePage
{
    protected $options = [
        'visibleInNavigation' => false,
        'renderedByFrontend' => false
    ];
}