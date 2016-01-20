@extends('cockpit::layouts.default.content.container')


@section('content')
    @include('cockpit::partials.pages.index_wrapper_open')

    @include('cockpit::partials.pages.index_actions')

    <div class="panel panel-bordered">
        <div class="panel-body">

            <form method="GET" action="http://mezzo.dev/api/events">
                <div class="row">
                    <div class="col-md-3">
                        <label>Search</label>
                        <input type="search" name="q" class="form-control"
                               placeholder="search">
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-8">
                                <label>Zipcode</label>
                                <input name="scopes[nearZip][0]" type="number" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Distance (km)</label>
                                <input name="scopes[nearZip][1]" class="form-control" type="number"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Provider</label>

                        <select name="event_provider_id" class="form-control">
                            <option value="">-</option>
                            @foreach($allProviders as $provider)
                                <option value="{{ $provider->id }}">{{ $provider->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 pull-right">
                        <br/>
                        <button type="button" class="btn btn-default btn-block" ng-click="vm.applyScopes($event)">Submit</button>
                    </div>
                </div>
            </form>


        </div>
    </div>

    @include('cockpit::partials.pages.index_table')

    @include('cockpit::partials.pages.index_wrapper_close')
@endsection