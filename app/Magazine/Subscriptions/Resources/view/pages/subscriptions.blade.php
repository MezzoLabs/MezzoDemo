@extends(cockpit_content_container())

@section('content')

    <div class="wrapper" ng-init="vm.init('User', 'subscriptions')">

        {{ $module_page->renderSection('main_panel:before') }}

        <div class="row">
            <div class="col-md-4">
                <div class="main-panel panel panel-bordered">
                    {!! cockpit_form()->open(['angular' => true]) !!}
                    <div class="panel-heading">
                        <h3>@lang('mezzo.general.creating') {{ trans_choice('mezzo.models.subscription', 1) }}</h3>
                        <div class="panel-actions">
                            <a class="highlight" href="/mezzo/user/user/edit/@{{ vm.modelId }}"><i
                                        class="ion-arrow-return-left"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! $model_reflection->schema()->attributes('subscriptions')->render(['index' => 'new']) !!}
                    </div>
                    <div class="panel-footer text-right">
                        {!! cockpit_form()->submitCreate($model_reflection, trans('mezzo.general.creating')) !!}
                    </div>
                    {!! cockpit_form()->close() !!}

                </div>
            </div>
            <div class="col-md-8">
                <div class="main-panel panel panel-bordered">
                    <div class="panel-heading">
                        <h3>{{ trans_choice('mezzo.models.subscription', 2) }} {{ trans('mezzo.general.for') }}
                            "@{{ vm.user()._label }}"</h3>
                    </div>
                    <div class="panel-body">
                        @include('modules.subscriptions::partials.subscriptions_list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ $module_page->renderSection('main_panel:after') }}

    @include('cockpit::partials.pages.edit_wrapper_close')

@endsection