<?php

namespace MezzoLabs\Mezzo\Modules\Sample\Http\Controllers;


use Illuminate\Http\Request;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleController;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleRequest;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleResponse;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleResourceController;

class TutorialController extends ModuleResourceController
{
    public function showListPage()
    {
        $this->addData
    }

    public function showAddPage()
    {

    }

    /**
     * Display the page to edit a Tutorial.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function showEditPage($id)
    {

    }
}