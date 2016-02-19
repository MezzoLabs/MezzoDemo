@extends('cockpit::layouts.default.partial_layouts.index_filters')

@section('filters_form')
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ trans('mezzo.modules.events.starting_at') }}</label>
                <input data-mezzo-datetimepicker type="text" name="scopes[betweenDates][0]"
                       class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ trans('mezzo.modules.events.ending_at') }}</label>
                <input data-mezzo-datetimepicker type="text" name="scopes[betweenDates][1]"
                       class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>{{ trans('validation.attributes.zip') }}</label>
                        <input name="scopes[nearZip][0]" type="number" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ trans('validation.attributes.distance') }} (km)</label>
                        <input name="scopes[nearZip][1]" class="form-control" type="number"/>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ trans('validation.attributes.eventprovider') }}</label>
                <select name="event_provider_id" class="form-control">
                    <option value="">-</option>
                    @foreach($allProviders as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
@endsection