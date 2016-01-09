@extends('cockpit::layouts.default.content.container')


@section('content')
    @include('cockpit::partials.pages.index_wrapper_open')

    @include('cockpit::partials.pages.index_actions')

    <div class="panel panel-bordered">
        <div class="panel-body">

            <div class="row">
                <div class="col-md-3">
                    <label>Search</label>
                    <input type="search" class="form-control"
                           placeholder="search">
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-8">
                            <label>Location</label>
                            <input type="search" class="form-control"
                                   placeholder="Google search">
                        </div>
                        <div class="col-md-4">
                            <label>Distance (km)</label>
                            <input class="form-control" type="number"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Provider</label>
                    <select class="form-control">
                        <option>Marc</option>
                        <option>Simon</option>
                        <option>Dei Mudda</option>
                    </select>
                </div>
            </div>


        </div>
    </div>

    @include('cockpit::partials.pages.index_table')

    @include('cockpit::partials.pages.index_wrapper_close')
@endsection