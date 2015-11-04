<?php


namespace MezzoLabs\Mezzo\Cockpit\Pages\Resources;


class EditResourcePage extends ResourcePage
{
    protected $action = 'edit';

    protected $options = [
        'visibleInNavigation' => false,
    ];

    protected $view = 'cockpit::pages.resources.edit';

}