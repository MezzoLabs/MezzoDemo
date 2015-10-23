<?php

namespace MezzoLabs\Mezzo\Modules\Sample\Http\Controllers;


use MezzoLabs\Mezzo\Http\Controllers\ResourceController;
use MezzoLabs\Mezzo\Http\Requests\ModuleRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;
use MezzoLabs\Mezzo\Modules\Sample\Http\Pages\IndexTutorialPage;

class TutorialController extends ResourceController
{
    /**
     * Display a listing of the resource.
     *
     * @param ModuleRequest $request
     * @return ModuleResponse
     */
    public function index(ModuleRequest $request)
    {
        return $this->page(IndexTutorialPage::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return ModuleResponse
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ModuleRequest $request
     * @return ModuleResponse
     */
    public function store(ModuleRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ModuleRequest $request
     * @param  int $id
     * @return ModuleResponse
     */
    public function update(ModuleRequest $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return ModuleResponse
     */
    public function destroy($id)
    {
    }


}