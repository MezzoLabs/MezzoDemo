@extends('cockpit::layouts.default.partial_layouts.index_filters')

@section('filters_form')
    <form method="GET" action="http://mezzo.dev/api/posts">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Published</label>
                    <select name="scopes[isPublished][0]" class="form-control">
                        <option value="">Both</option>
                        <option value="1">Public</option>
                        <option value="0">Private</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 text-right">
                <br/>
                <button type="button" class="btn btn-default btn-block" ng-click="vm.applyScopes($event)">
                    Submit
                </button>
            </div>
        </div>
    </form>
@endsection