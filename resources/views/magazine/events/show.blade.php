@extends('magazine.layout')

@section('content')

    <div class="post">
        <h1>{{ $event->title }}</h1>

        @foreach($event->images as $image)
            {{ $image->url('thumb') }}
        @endforeach

        <ul>

            @foreach($event->days as $day)
                <li>{{ Html::timeSpan($day->start, $day->end) }}</li>
            @endforeach
        </ul>

    </div>





@endsection