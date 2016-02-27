@section('heading')
    @include('cockpit::partials.pages.create_or_edit.heading')
@endsection


@section('submit')
    @include('cockpit::partials.pages.create_or_edit.submit')
@endsection

@section('form_content')
    @include('cockpit::partials.pages.create_or_edit.form_content')
@endsection

{!! cockpit_form()->open(['angular' => true]) !!}
{{ $module_page->renderSection('main_panel:before') }}


<div class="panel panel-bordered">
    <div class="panel-heading">
        @yield('heading')
    </div>
    <div class="panel-body">
        @yield('form_content')
    </div>
    <div class="panel-footer text-right">
        @yield('submit')
    </div>
</div>

{{ $module_page->renderSection('main_panel:after') }}


{!! cockpit_form()->close() !!}