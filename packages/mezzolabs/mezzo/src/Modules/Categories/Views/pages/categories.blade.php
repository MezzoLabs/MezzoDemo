@extends(cockpit_content_container())

@section('content')
    <div class="wrapper">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h3>Manage Categories</h3>

                <div class="panel-actions">
                </div>
            </div>
            <div class="panel-body">

                @foreach($category_groups as $group)
                    <h3>{{ $group->label }}</h3>

                    <h4>Manages</h4>
                    {!! cockpit_html()->ol($group->modelClasses()) !!}

                    <h4>Categories</h4>
                    <ul>
                    @foreach($group->tree() as $category)
                        @include('modules.categories::partials.nested_list', ['element' => $category])
                    @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
    </div>

@endsection