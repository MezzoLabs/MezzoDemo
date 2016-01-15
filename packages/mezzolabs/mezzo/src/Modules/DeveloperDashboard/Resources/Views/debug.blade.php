@extends('cockpit::layouts.default.content.container')

@section('content')
    <div class="wrapper">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>Debug</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">
                Welcome to my world
                <mezzo-datetime-picker></mezzo-datetime-picker>
            </div>
        </div>
    </div>
@endsection
