@extends(cockpit_content_container())


@section('content')
    <div class="wrapper">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>New {{ $model->name() }}</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">
                {!! cockpit_form()->open() !!}
                @foreach($model->attributes()->fillableOnly() as $attribute)
                    <div class="form-group">
                        <label>{{ $attribute->title() }}</label>
                        {!! $attribute->render() !!}
                    </div>
                @endforeach
                {!! cockpit_form()->submit('Save as new ' . $model->name()) !!}
                {!! cockpit_form()->close() !!}

            </div>
        </div>
    </div>

@endsection