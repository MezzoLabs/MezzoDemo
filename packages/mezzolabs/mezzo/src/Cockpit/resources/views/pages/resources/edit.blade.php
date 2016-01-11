@extends(cockpit_content_container())


@section('content')
    @include('cockpit::partials.pages.edit_wrapper_open')
    <div class="panel panel-bordered">
        <div class="panel-heading">
            @include('cockpit::partials.pages.edit_heading')

        </div>
        <div class="panel-body">
            {!! cockpit_form()->open(['angular' => true]) !!}
            @include(cockpit_html()->viewKey('form-content-edit'))
            {!! cockpit_form()->close() !!}
        </div>
    </div>
    @include('cockpit::partials.pages.edit_wrapper_close')

@endsection