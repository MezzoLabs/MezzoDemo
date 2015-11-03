<?php


namespace MezzoLabs\Mezzo\Cockpit\Pages\Resources;


abstract class IndexResourcePage extends ResourcePage
{
    protected $action = 'index';

    protected $view = 'cockpit::pages.resources.index';

    protected $options = [
        'visibleInNavigation' => true,
    ];
}