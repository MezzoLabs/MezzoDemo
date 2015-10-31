<?php

namespace MezzoLabs\Mezzo\Cockpit\Html;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class SidebarHelper extends HtmlHelper
{
    public function moduleCssClass(ModuleProvider $module)
    {
        $visiblePages = $module->pages()->filterVisibleInNavigation();

        $this->decideCssClass($visiblePages->isEmpty(), 'has-no-pages', 'has-pages');

        //@TODO
        //$this->addCssClass('opened');

        return $this->cssClassString();
    }

    public function cssClass($parameters)
    {
        if($parameters instanceof ModuleProvider)
            return $this->moduleCssClass($parameters);
    }
}