@extends(cockpit_content_container())

@section('content')
    <div class="wrapper row">
        <div class="col-md-3">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3>Add Category</h3>
                </div>
                {!! cockpit_form()->open(['route' => 'cockpit::category.store', 'method' => 'POST']) !!}
                <div class="panel-body">
                    @include(cockpit_html()->viewKey('form-content-create'), [
                        'hide_submit' => false, 'without' => ['content_id', 'slug']])
                </div>
                {!! cockpit_form()->close() !!}
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3>Manage Categories</h3>

                    <div class="panel-actions">
                    </div>
                </div>
                <div class="panel-body">

                    @foreach($category_groups as $group)
                        <h3>{{ $group->label }}</h3>
                        @foreach($group->modelClasses() as $modelClass)
                            <span class="label label-default">{{ $modelClass }}</span>
                        @endforeach

                        <h4>Categories</h4>
                        <dib class="list-group">
                            @foreach($group->tree() as $category)
                                @include('modules.categories::partials.nested_list', ['element' => $category, 'level' => 0])
                            @endforeach
                        </dib>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection