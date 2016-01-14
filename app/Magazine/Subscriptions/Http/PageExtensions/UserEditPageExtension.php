<?php


namespace App\Magazine\Subscriptions\Http\PageExtensions;


use MezzoLabs\Mezzo\Http\Pages\ModulePageExtension;

class UserEditPageExtension extends ModulePageExtension
{


    /**
     * An array of variables that will be shared to the view.
     *
     * @return array
     */
    public function data($controllerData) : array
    {
        return [

        ];
    }

    public function boot()
    {
        //$this->addViewToSection('main_panel:after', 'modules.subscriptions::subscription_section');
    }
}