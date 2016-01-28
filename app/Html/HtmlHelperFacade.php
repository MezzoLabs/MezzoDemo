<?php


namespace App\Html;

use Collective\Html\FormFacade as CollectiveFormFacade;

class HtmlHelperFacade extends CollectiveFormFacade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'magazine_htmlhelper';
    }
}