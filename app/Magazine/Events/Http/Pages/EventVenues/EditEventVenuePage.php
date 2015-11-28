<?php


namespace App\Magazine\Events\Http\Pages\EventVenues;


use MezzoLabs\Mezzo\Cockpit\Pages\Resources\EditResourcePage;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class EditEventVenuePage extends EditResourcePage
{
    /**
     * @param ModuleProvider $module
     * @throws ModulePageException
     * @internal param array $options
     */
    public function __construct(ModuleProvider $module)
    {
        parent::__construct($module);

        $this->options('renderedByFrontend', false);
    }


}