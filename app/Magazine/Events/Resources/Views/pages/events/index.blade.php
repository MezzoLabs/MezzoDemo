@extends('cockpit::layouts.default.content.container')


@section('content')
    @include('cockpit::partials.pages.index_wrapper_open')

    @include('cockpit::partials.pages.index_actions')

    <div class="panel panel-bordered panel-collapsible">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a data-toggle="collapse" data-target="#extra_filters"><i class="ion-funnel light-icon highlight"></i><span>Filters</span></a>
            </h3>
        </div>
        <div id="extra_filters" class="panel-collapse collapse">
            <div class="panel-body">

                <form method="GET" action="http://mezzo.dev/api/events">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>From</label>
                                <input data-mezzo-datetimepicker type="text" name="scopes[betweenDates][0]"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>To</label>
                                <input data-mezzo-datetimepicker type="text" name="scopes[betweenDates][1]"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Zipcode</label>
                                        <input name="scopes[nearZip][0]" type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Distance (km)</label>
                                        <input name="scopes[nearZip][1]" class="form-control" type="number"/>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Provider</label>
                                <select name="event_provider_id" class="form-control">
                                    <option value="">-</option>
                                    @foreach($allProviders as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 pull-right">
                            <br/>
                            <button type="button" class="btn btn-default btn-block" ng-click="vm.applyScopes($event)">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

    @include('cockpit::partials.pages.index_table')

    @include('cockpit::partials.pages.index_wrapper_close')
@endsection