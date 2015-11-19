@extends(cockpit_content_container())


@section('content')
    <div class="wrapper">
        {!! cockpit_form()->open(['route' => 'cockpit::page.store', 'method' => 'POST']) !!}
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>New {{ $model->name() }}</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">
                @foreach($model->attributes()->fillableOnly()->forget(['content_id', 'slug']) as $attribute)
                    <div class="form-group">
                        <label>{{ $attribute->title() }}</label>
                        {!! $attribute->render() !!}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>Content</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">
                @include('modules.contents::block_type_select')
            </div>

        @foreach($blocks as $block)
                <div class="panel-heading">
                    <h3>{{ $block->title() }}</h3>

                    <div class="panel-actions">
                    </div>
                </div>
                <div class="panel-body">
                    <input type="hidden" name="{{ $block->propertyInputName('class') }}" value="{{ $block->key() }}">

                    <div class="block-{{ $block->key() }}">
                        {!! $block->inputsView() !!}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="panel panel-bordered">

            {!! cockpit_form()->submit('Save as new ' . $model->name()) !!}
        </div>


        {!! cockpit_form()->close() !!}
    </div>

@endsection