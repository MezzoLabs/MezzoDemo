@extends(cockpit_content_container())


@section('content')

    <div class="wrapper">
        {!! cockpit_form()->open(['route' => 'cockpit::page.store', 'method' => 'POST']) !!}
        <div class="panel panel-bordered">
            <div class="panel-heading">
                @include('cockpit::partials.pages.heading_create')
            </div>
            <div class="panel-body">
                @include(cockpit_html()->viewKey('form-content-create'), [
                        'hide_submit' => true, 'without' => ['content_id', 'slug']])
            </div>
        </div>

        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>Content</h3>

                <div class="panel-actions">
                </div>
            </div>
            @include('modules.contents::block_type_select')

            <div class="panel panel-bordered">
                {!! cockpit_form()->submit('Save as new ' . $model_reflection->name()) !!}
            </div>


            {!! cockpit_form()->close() !!}
        </div>

@endsection