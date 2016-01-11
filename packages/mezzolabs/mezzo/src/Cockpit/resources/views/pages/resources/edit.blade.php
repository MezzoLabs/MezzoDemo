@extends(cockpit_content_container())


@section('content')
    <div class="wrapper"
         ng-init="vm.init('{!! $model_reflection->name() !!}',  {!! str_replace('"', "'", $model_reflection->defaultIncludes()->toJson()) !!})">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                @include('cockpit::partials.pages.heading_edit')

            </div>
            <div class="panel-body">
                {!! cockpit_form()->open(['angular' => true]) !!}
                @include(cockpit_html()->viewKey('form-content-edit'))
                {!! cockpit_form()->close() !!}
            </div>
        </div>
    </div>

@endsection