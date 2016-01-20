@extends(cockpit_content_container())

@section('content')
    @include('cockpit::partials.pages.edit_wrapper_open', ['includes' => ['subscriptions']])

    {{ $module_page->renderSection('main_panel:before') }}
    {!! cockpit_form()->open(['angular' => true]) !!}

    <div class="row">
        <div class="col-md-4">
            <div class="main-panel panel panel-bordered">
                <div class="panel-heading">
                    <h3>Add Subscription</h3>
                    <div class="panel-actions">
                        <a class="highlight" href="/mezzo/user/user/edit/@{{ vm.modelId }}"><i
                                    class="ion-arrow-return-left"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    {!! $model_reflection->schema()->attributes('subscriptions')->render() !!}
                </div>
                <div class="panel-footer text-right">
                    <input type="submit" class="btn btn-primary"/>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="main-panel panel panel-bordered">
                <div class="panel-heading">
                    <h3>Subscriptions for @{{ vm.content.email }}</h3>
                </div>
                <div class="panel-body">
                    @include('modules.user::partials.subscriptions_list')
                </div>
            </div>
        </div>
        </div>
    </div>

    </div>


    {!! cockpit_form()->close() !!}

    {{ $module_page->renderSection('main_panel:after') }}

    @include('cockpit::partials.pages.edit_wrapper_close')

@endsection