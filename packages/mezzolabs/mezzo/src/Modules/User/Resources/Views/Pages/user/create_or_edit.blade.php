@extends("cockpit::pages.layouts.create_or_edit")

@section('wrapper-content')
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    @include('cockpit::partials.pages.create_or_edit_heading')
                </div>
                <div class="panel-body">
                    @include(cockpit_html()->viewKey('form-content.create_or_edit'), ['without' => 'password'])
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <h3>Password</h3>
                        </div>
                        <div class="panel-body">
                            {!! $model_reflection->schema()->attributes('password')->render() !!}
                        </div>
                    </div>
                </div>

                @if($module_page->isType('edit'))
                    <div class="col-md-12">
                        <div class="panel panel-bordered">
                            <div class="panel-heading">
                                <h3>Subscriptions</h3>
                            </div>
                            <div class="panel-body">
                                <mezzo-subscriptions user="@{{ vm.id }}"></mezzo-subscriptions>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>

    </div>

@endsection