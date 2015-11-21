@extends(cockpit_content_container())


@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-md-9">
                {!! cockpit_form()->open(['route' => 'cockpit::post.store', 'method' => 'POST']) !!}
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3>New {{ $model->name() }}</h3>

                        <div class="panel-actions">
                        </div>
                    </div>
                    <div class="panel-body">
                        @include(cockpit_html()->viewKey('form-content-create'), [
                        'hide_submit' => true, 'without' => ['main_image_id', 'published_at', 'slug', 'state']])
                    </div>
                </div>
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3>Content</h3>
                    </div>
                    @include('modules.contents::block_type_select')
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3>Publish</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Creator</label>
                            {!! $model->schema()->attributes('user_id')->render() !!}
                        </div>
                        <div class="form-group">
                            <label>Main Image</label>
                            {!! $model->schema()->attributes('main_image_id')->render() !!}
                        </div>
                        <div class="form-group">
                            <label>Publish At</label>
                            {!! $model->schema()->attributes('published_at')->render() !!}
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            {!! $model->schema()->attributes('state')->render() !!}
                        </div>

                        {!! cockpit_form()->submit('Save as new ' . $model->name()) !!}
                    </div>
                </div>
            </div>
        </div>


        {!! cockpit_form()->close() !!}
    </div>

@endsection