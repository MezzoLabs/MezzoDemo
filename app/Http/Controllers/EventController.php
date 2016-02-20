<?php


namespace App\Http\Controllers;


use App\Http\Requests\ShowEventRequest;

class EventController extends Controller
{
    public function getIndex()
    {
        return view('magazine.events.index', ['events' => \App\Event::orderBy('updated_at', 'desc')->paginate(5)]);
    }

    public function getShow(ShowEventRequest $request, $id)
    {
        return view('magazine.events.show', ['event' => \App\Event::findOrFail($id)]);
    }
}