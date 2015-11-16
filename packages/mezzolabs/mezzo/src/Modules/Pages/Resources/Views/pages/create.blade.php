@extends(cockpit_content_container())


@section('content')
    <div class="wrapper">
        {!! cockpit_form()->open(['route' => 'cockpit::store_page', 'method' => 'POST']) !!}
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>New {{ $model->name() }}</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">
                @foreach($model->attributes()->fillableOnly() as $attribute)
                    <div class="form-group">
                        <label>{{ $attribute->title() }}</label>
                        {!! $attribute->render() !!}
                    </div>
                @endforeach
            </div>
            <div class="panel-heading">
                <h3>Content</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">
                @foreach($blocks as $block)
                    <input type="hidden" name="{{ $block->propertyInputName('class') }}" value="{{ $block->key() }}">
                    <div class="block-{{ $block->key() }}">
                        <h3>{{ $block->title() }}</h3>
                        {!! $block->renderInputs() !!}
                    </div>
                @endforeach
                {!! cockpit_form()->submit('Save as new ' . $model->name()) !!}

            </div>

        </div>
        {!! cockpit_form()->close() !!}
    </div>

@endsection