@extends(cockpit_content_container())


@section('content')
    @include('cockpit::partials.pages.edit_wrapper_open')
    {!! cockpit_form()->open(['angular' => true]) !!}
    <div class="panel panel-bordered">
        <div class="panel-heading">
            @if($module_page->isType('create'))
                @include('cockpit::partials.pages.create_heading')
            @else
                @include('cockpit::partials.pages.edit_heading')
            @endif
        </div>
        <div class="panel-tabs">
            @include('modules.events::partials.event_form_tabs')
        </div>

        <div class="panel-body">
            @include('modules.events::partials.event_form_tabs_content')

        </div>
        <div class="panel-footer text-right">
            @if($module_page->isType('create'))
                {!! cockpit_form()->submitCreate($model_reflection) !!}
            @else
                {!! cockpit_form()->submitEdit($model_reflection) !!}
            @endif
        </div>
    </div>

    {!! cockpit_form()->close() !!}
    @include('cockpit::partials.pages.edit_wrapper_close')

@endsection