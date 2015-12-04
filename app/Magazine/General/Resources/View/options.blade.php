@extends(cockpit_content_container())

@section('content')
    <div class="wrapper">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>Options</h3>
            </div>
            <div class="panel-body">
                {!! cockpit_form()->open(['route' => 'modules']) !!}
                @foreach($options as $option)
                    <div class="form-group">
                        <label>{{ $option->title() }}</label>
                        {!! cockpit_form()->optionField($option) !!}
                    </div>
                @endforeach
                {!! cockpit_form()->submit() !!}
                {!! cockpit_form()->close() !!}

            </div>
        </div>
    </div>

@endsection