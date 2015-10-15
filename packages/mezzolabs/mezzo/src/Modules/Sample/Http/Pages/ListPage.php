<?php


namespace MezzoLabs\Mezzo\Modules\Sample\Http\Pages;


use MezzoLabs\Mezzo\Core\Modularisation\Http\ModulePage;

class ListPage extends ModulePage
{
    protected  $title  = "List Tutorials";

    /**
     * Deliver the HTML code to the cockpit.
     *
     * @param array $data
     * @return string
     * @throws \MezzoLabs\Mezzo\Exceptions\ModulePageException
     */
    public function template($data)
    {
        parent::template($data);
    }
}