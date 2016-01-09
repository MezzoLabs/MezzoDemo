@extends('magazine.layout')

@section('content')

    <h3>Categories</h3>

    <form method="POST" action="{{ url('profile/liked-categories') }}">
        @include('magazine.profile.liked_category_children', ['children' => $categories['all']])

        <input type="submit">
    </form>
@endsection

