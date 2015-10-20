<?php

namespace MezzoLabs\Mezzo\Modules\Sample\Http\Controllers;


use Illuminate\Http\Request;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleController;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleRequest;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleResponse;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleResourceController;
use MezzoLabs\Mezzo\Modules\Sample\Http\Pages\ListTutorialPage;

class TutorialController extends ModuleResourceController
{

    public function showListPage()
    {
        $this->data('tutorials', $this->repository()->all());

        return $this->page(ListTutorialPage::class);
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