@extends(cockpit_content_container())

@section('content')
    @include('cockpit::partials.pages.edit_wrapper_open')
    {!! cockpit_form()->open(['angular' => true]) !!}
    @yield('wrapper-content')
    {!! cockpit_form()->close() !!}
    @include('cockpit::partials.pages.edit_wrapper_close')
@endsection