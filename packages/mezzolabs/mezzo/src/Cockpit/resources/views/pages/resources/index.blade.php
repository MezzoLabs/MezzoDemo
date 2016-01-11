@extends('cockpit::layouts.default.content.container')


@section('content')

    @include('cockpit::partials.pages.index_wrapper_open')

    @include('cockpit::partials.pages.index_actions')

    @include('cockpit::partials.pages.index_table')

    @include('cockpit::partials.pages.index_wrapper_close')


@endsection