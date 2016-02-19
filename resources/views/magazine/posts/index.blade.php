@extends('magazine.layout')

@section('content')

    <div class="posts">
        @foreach($posts as $post)
            <div class="post panel">
                <div class="panel-heading">
                    <h3>{{ $post->title }}</h3>
                </div>
                <div class="panel-body">
                    {{ $post->teaser }}
                </div>
            </div>
        @endforeach
    </div>


    {!! $posts->render()  !!}




@endsection