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
                {!! cockpit_form()->open() !!}
                @foreach($model->attributes() as $attribute)
                    <div class="form-group">
                        <label>{{ $attribute->title() }}</label>
                        {!! $attribute->render() !!}
                    </div>
                @endforeach
                {!! cockpit_form()->submit() !!}
                {!! cockpit_form()->close() !!}

            </div>
        </div>
    </div>
@endsection
