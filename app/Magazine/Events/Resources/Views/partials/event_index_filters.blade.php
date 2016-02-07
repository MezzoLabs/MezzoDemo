@extends('cockpit::layouts.default.partial_layouts.index_filters')

@section('filters_form')
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
@endsection