<?php


namespace App\Magazine\Events\Http\Controllers;


use App\Magazine\Events\Http\Pages\EventVenues\CreateEventVenuePage;
use App\Magazine\Events\Http\Pages\EventVenues\EditEventVenuePage;
use App\Magazine\Events\Http\Pages\EventVenues\IndexEventVenuePage;
use MezzoLabs\Mezzo\Http\Controllers\CockpitResourceController;
use MezzoLabs\Mezzo\Http\Requests\Resource\CreateResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\EditResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\IndexResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\ShowResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\StoreResourceRequest;
use MezzoLabs\Mezzo\Http\Requests\Resource\UpdateResourceRequest;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponse;

class EventVenueController extends CockpitResourceController
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexResourceRequest $request
     * @return ModuleResponse
     */
    public function index(IndexResourceRequest $request)
    {
        return $this->page(IndexEventVenuePage::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateResourceRequest $request
     * @return ModuleResponse
     */
    public function create(CreateResourceRequest $request)
    {
        return $this->page(CreateEventVenuePage::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param ShowResourceRequest $request
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
        return $this->page(EditEventVenuePage::class);
    }

    public function store(StoreResourceRequest $request)
    {
        $event = $this->repository()->createWithNestedRelations(
            $request->formObject()->data()->toArray(),
            $request->nestedRelations()
        );

        return $this->redirectToPage(EditEventVenuePage::class, $event->id)->with('message', 'Event venue created successfully.');
    }

    public function update(UpdateResourceRequest $request, $id)
    {
        $event = $this->repository()->updateWithNestedRelations(
            $request->formObject()->data()->toArray(),
            $id,
            $request->nestedRelations()
        );

        mezzo_dd('updated');

        return $this->redirectToPage(EditEventVenuePage::class, $event->id)->with('message', 'Event venue updated successfully.');

    }

}