<?php


namespace App\Magazine\Events\Http\Pages\Events;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\CreateResourcePage;

class CreateEventPage extends CreateResourcePage
{
    protected $options = [
        'visibleInNavigation' => true,
        'renderedByFrontend' => false
    ];
}