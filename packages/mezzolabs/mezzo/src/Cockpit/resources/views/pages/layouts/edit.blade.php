@extends(cockpit_content_container())


@section('content')
    @include('cockpit::partials.pages.edit_wrapper_open')

    @yield('main_panel:before')
    {{ $module_page->renderSection('main_panel:before') }}

    <div class="main-panel panel panel-bordered">
        <div class="panel-heading">
            @include('cockpit::partials.pages.edit_heading')
        </div>
        <div class="panel-body">
            {!! cockpit_form()->open(['angular' => true]) !!}
            @include(cockpit_html()->viewKey('form-content-edit'))
            {!! cockpit_form()->close() !!}
        </div>
    </div>

    @yield('main_panel:after')
    {{ $module_page->renderSection('main_panel:after') }}

    @include('cockpit::partials.pages.edit_wrapper_close')
@endsection