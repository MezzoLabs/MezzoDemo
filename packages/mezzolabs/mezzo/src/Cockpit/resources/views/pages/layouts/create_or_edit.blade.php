@extends(cockpit_content_container())

@section('create_or_edit_wrapper_open')
    @include('cockpit::partials.pages.create_or_edit.wrapper_open')
@endsection

@section('create_or_edit_form')
    @include('cockpit::partials.pages.create_or_edit.form')
@endsection

@section('create_or_edit_wrapper_close')
    @include('cockpit::partials.pages.create_or_edit.wrapper_close')
@endsection

@section('content')
    @yield('create_or_edit_wrapper_open')
    @yield('create_or_edit_form')
    @yield('create_or_edit_wrapper_close')

@endsection