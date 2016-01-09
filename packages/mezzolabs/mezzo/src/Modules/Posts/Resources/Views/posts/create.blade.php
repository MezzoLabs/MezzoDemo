@extends(cockpit_content_container())


@section('content')
    <div class="wrapper" ng-init="vm.init('{{ $model_reflection->name() }}')">
        {!! cockpit_form()->open(['angular' => true]) !!}
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        @include('cockpit::partials.pages.heading_create')
                    </div>
                    <div class="panel-body">
                        @include(cockpit_html()->viewKey('form-content-create'), [
                        'hide_submit' => true, 'without' => ['user_id', 'content_id', 'main_image_id', 'published_at', 'slug', 'state']])
                    </div>
                </div>
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3>Content</h3>
                    </div>
                    {!! $model_reflection->schema()->attributes('content_id')->render() !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3>Publish</h3>
                    </div>
                    <div class="panel-body">
                        {!! $model_reflection->schema()->attributes('user_id')->render() !!}
                        {!! $model_reflection->schema()->attributes('main_image_id')->render() !!}
                        {!! $model_reflection->schema()->attributes('published_at')->render() !!}
                        {!! $model_reflection->schema()->attributes('state')->render() !!}
                        {!! cockpit_form()->submit('Save as new ' . $model_reflection->name()) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! cockpit_form()->close() !!}
    </div>

@endsection