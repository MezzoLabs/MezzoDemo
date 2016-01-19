@extends(cockpit_content_container())

@section('content')
    <div class="wrapper" ng-init="vm.init('{{ $model_reflection->name() }}')">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                @include('cockpit::partials.pages.create_heading')
            </div>
            <div class="panel-body">
                {!! cockpit_form()->open(['angular' => true]) !!}
                @include(cockpit_html()->viewKey('form-content-create'))
                {!! cockpit_form()->close() !!}

            </div>
        </div>
    </div>
@endsection