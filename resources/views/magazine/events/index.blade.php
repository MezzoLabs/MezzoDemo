@extends('magazine.layout')

@section('content')

    <div class="events">
        @foreach($events as $event)
            <div class="event panel">
                <div class="panel-heading">
                    <h3>{{ $event->title }}</h3>
                </div>
                <div class="panel-body">
                    {{ Html::timeSpan($event->start(), $event->end()) }}
                </div>
                <div class="panel-footer text-right">
                    <a href="{{ route('events.show', $event->id) }}">Show</a>
                </div>
            </div>
        @endforeach
    </div>


    {!! $events->render()  !!}




@endsection