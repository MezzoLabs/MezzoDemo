<!doctype html>
<html ng-app="Mezzo">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mezzo</title>
    <base href="/">
    <!-- CSS -->
    {!! cockpit_stylesheet('/components/roboto-fontface/css/roboto-fontface.css') !!}
    {!! cockpit_stylesheet('/components/Ionicons/css/ionicons.min.css') !!}
    {!! cockpit_stylesheet('/components/font-awesome/css/font-awesome.min.css') !!}
    {!! cockpit_stylesheet('/components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') !!}
    {!! cockpit_stylesheet('/components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') !!}
    {!! cockpit_stylesheet('/components/sweetalert2/dist/sweetalert2.css') !!}
    {!! cockpit_stylesheet('/components/gridster/dist/jquery.gridster.min.css') !!}
    {!! cockpit_stylesheet('/components/chosen/chosen.min.css') !!}
    {!! cockpit_stylesheet('/css/app.css') !!}
            <!-- CSS -->
</head>
<body class="@yield('body-class', 'sidebar-pinned') @if($errors->has() || session('message')) has-errors @endif">
<!-- Content -->
<div id="page-container">
    @include('cockpit::layouts.default.sidebar')
    <div id="view-main">
        @include('cockpit::layouts.default.topbar')
        @include('cockpit::layouts.default.errors')
        @if( ! isset($content_container) )
            <div ui-view></div>
        @else
            {!! $content_container !!}
        @endif
    </div>
</div>
<!-- Content -->
<!-- JavaScript -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBm2n4bQfABTkiGxQp7e-QvWRPQhvAhjGM&libraries=places"></script>
{!! cockpit_script('/components/jquery/dist/jquery.min.js') !!}
{!! cockpit_script('/components/jquery-ui/jquery-ui.min.js') !!}
{!! cockpit_script('/components/bootstrap-sass/assets/javascripts/bootstrap.js') !!}
{!! cockpit_script('/components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js') !!}
{!! cockpit_script('/components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
{!! cockpit_script('/components/select2/dist/js/select2.js') !!}
{!! cockpit_script('/components/gridster/dist/jquery.gridster.min.js') !!}
{!! cockpit_script('/components/angular/angular.js') !!}
{!! cockpit_script('/components/angular-ui-router/release/angular-ui-router.min.js') !!}
{!! cockpit_script('/components/angular-messages/angular-messages.min.js') !!}
{!! cockpit_script('/components/angular-sortable-view/src/angular-sortable-view.min.js') !!}
{!! cockpit_script('/components/angular-ui-sortable/sortable.min.js') !!}
{!! cockpit_script('/components/ng-file-upload/ng-file-upload.min.js') !!}
{!! cockpit_script('/components/angular-loading-bar/build/loading-bar.min.js') !!}
{!! cockpit_script('/components/chosen/chosen.jquery.min.js') !!}
{!! cockpit_script('/components/pluralize/pluralize.js') !!}
{!! cockpit_script('/components/sweetalert2/dist/sweetalert2.min.js') !!}
{!! cockpit_script('/components/moment/min/moment.min.js') !!}
{!! cockpit_script('/components/lodash/lodash.min.js') !!}
{!! cockpit_script('/components/js-md5/build/md5.min.js') !!}
{!! cockpit_script('/js/lib/form2js.js') !!}
{!! cockpit_script('/js/lib/js2form.js') !!}
{!! cockpit_script('/js/lib/jquery.toObject.js') !!}
{!! cockpit_script('/js/app.js') !!}
<!-- JavaScript -->
</body>
</html>