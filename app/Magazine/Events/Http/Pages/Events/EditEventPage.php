<?php


namespace App\Magazine\Events\Http\Pages\Events;

use MezzoLabs\Mezzo\Cockpit\Pages\Resources\EditResourcePage;

class EditEventPage extends EditResourcePage
{
    protected $options = [
        'visibleInNavigation' => false,
        'appendToUri' => '/{id}',
        'renderedByFrontend' => false
    ];

}