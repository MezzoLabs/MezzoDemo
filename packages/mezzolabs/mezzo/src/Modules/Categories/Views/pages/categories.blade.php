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

                @endforeach
            </div>
        </div>
    </div>

@endsection