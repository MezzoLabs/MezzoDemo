@extends(cockpit_content_container())

@section('content')
    <div class="wrapper">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>Options</h3>
            </div>
            <div class="panel-body">
                {!! cockpit_form()->open(['route' => 'cockpit::magazine.options.store']) !!}
                @foreach($options as $option)
                    {!! cockpit_form()->formGroup('options[' . $option->name() . ']') !!}
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