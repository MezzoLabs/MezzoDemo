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
                {!! cockpit_form()->open(['action' => '']) !!}
                    {!! cockpit_form()->file('file') !!}
                    {!! cockpit_form()->text('directory') !!}
                {!! cockpit_form()->submit() !!}
                {!! cockpit_form()->close() !!}

            </div>
        </div>
    </div>
@endsection