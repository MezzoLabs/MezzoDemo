<?php


namespace App\Html;

use Collective\Html\FormFacade as CollectiveFormFacade;

class FormFacade extends CollectiveFormFacade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'magazine_form';
    }
}