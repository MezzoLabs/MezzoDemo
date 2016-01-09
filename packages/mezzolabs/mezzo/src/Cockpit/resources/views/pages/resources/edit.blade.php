@extends(cockpit_content_container())


@section('content')
    <div class="wrapper">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                @include('cockpit::partials.pages.heading_edit')

            </div>
            <div class="panel-body">
                {!! cockpit_form()->open(['angular' => true]) !!}
                @include(cockpit_html()->viewKey('form-content-edit'))
                {!! cockpit_form()->close() !!}
            </div>
        </div>
    </div>

@endsection