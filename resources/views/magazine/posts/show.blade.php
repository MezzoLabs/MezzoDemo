@extends('magazine.layout')

@section('content')

    <div class="post">
        <h1>{{ $post->title }}</h1>

        <div class="teaser">
            {{ $post->teaser }}
        </div>

        <div class="content">
            @include('magazine.partials.content', ['content' => $post->content])
        </div>

        <div class="footer">
            Author: {{ $post->user->fullName() }}
            Date: {{ $post->created_at }}
        </div>

    </div>





@endsection