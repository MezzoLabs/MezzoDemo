<?php


namespace App\Magazine\Events\Http\Pages\Events;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\CreateResourcePage;

class CreateEventPage extends CreateResourcePage
{

    protected $view = 'modules.events::pages.events.create_or_edit';

    protected $options = [
        'visibleInNavigation' => true,
        'renderedByFrontend' => true
    ];

    public function boot()
    {
        $this->options('order', 0);
    }
}