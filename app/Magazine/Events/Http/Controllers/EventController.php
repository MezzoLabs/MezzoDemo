<?php

namespace App\Magazine\Events\Http\Controllers;

use App\Magazine\Events\Http\Pages\Events\CreateEventPage;
use App\Magazine\Events\Http\Pages\Events\EditEventPage;
use App\Magazine\Events\Http\Pages\Events\IndexEventPage;
use App\Magazine\Events\Http\Requests\StoreEventRequest;
use App\Magazine\Events\Http\Requests\UpdateEventRequest;
use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\CreateResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\EditResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\IndexResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\ShowResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;

class EventController extends CockpitResourceController
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexResourceRequest $request
     * @return ModuleResponse
     */
    public function index(IndexResourceRequest $request)
    {
        return $this->page(IndexEventPage::class);
    }


    /**
     * @param CreateResourceRequest $request
     * @return string
     */
    public function create(CreateResourceRequest $request)
    {
        return $this->page(CreateEventPage::class);
    }

    /**
     * Display the specified resource.
     *
     * @param ShowResourceRequest $request
     * @param  int $id
     * @return ModuleResponse
     */
    public function show(ShowResourceRequest $request, $id)
    {
        // TODO: Implement show() method.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditResourceRequest $request
     * @param  int $id
     * @return ModuleResponse
     */
    public function edit(EditResourceRequest $request, $id = 0)
    {
        /**
        $event = $this->repository()->findOrFail($id, ['*'], ['address', 'days', 'categories']);

        return $this->page(EditEventPage::class, [
        'model' => $event
        ]);
         */

        return $this->page(EditEventPage::class);
    }

    public function store(StoreEventRequest $request)
    {
        $event = $this->repository()->createWithNestedRelations(
            $request->formObject()->data()->toArray(),
            $request->nestedRelations()
        );

        return $this->redirectToPage(EditEventPage::class, $event->id)->with('message', 'Event created successfully.');
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $event = $this->repository()->updateWithNestedRelations(
            $request->formObject()->data()->toArray(),
            $id,
            $request->nestedRelations()
        );

        return $this->redirectToPage(EditEventPage::class, $event->id)->with('message', 'Event updated successfully.');

    }
}