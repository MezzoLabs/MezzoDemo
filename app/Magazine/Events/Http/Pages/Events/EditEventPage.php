<?php


namespace App\Magazine\Events\Http\Pages\Events;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\EditResourcePage;

class EditEventPage extends EditResourcePage
{
    protected $view = 'modules.events::pages.events.create_or_edit';


    protected $options = [
        'visibleInNavigation' => false,
        'appendToUri' => '/{id}'
    ];

}