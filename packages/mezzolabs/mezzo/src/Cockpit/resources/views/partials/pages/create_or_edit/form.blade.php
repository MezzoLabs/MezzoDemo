@section('create_or_edit_heading')
    @include('cockpit::partials.pages.create_or_edit.heading')
@endsection


@section('create_or_edit_submit')
    @include('cockpit::partials.pages.create_or_edit.submit')
@endsection

@section('crete_or_edit_form_content')
    @include('cockpit::partials.pages.create_or_edit.form_content')
@endsection

{!! cockpit_form()->open(['angular' => true]) !!}
<div class="panel panel-bordered">
    <div class="panel-heading">
        @yield('create_or_edit_heading')
    </div>
    <div class="panel-body">
        @yield('crete_or_edit_form_content')
    </div>
    <div class="panel-footer text-right">
        @yield('create_or_edit_submit)
    </div>
</div>

{!! cockpit_form()->close() !!}