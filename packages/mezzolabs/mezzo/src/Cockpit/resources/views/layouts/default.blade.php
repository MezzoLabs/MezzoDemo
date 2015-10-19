<!doctype html>
<html ng-app="Mezzo">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>App Name</title>
        <base href="/">

        <!-- CSS -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,400italic' rel='stylesheet' type='text/css'>
        <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="{{ cockpit_asset('/components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
        <link href="{{ cockpit_asset('/components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
        <link href="{{ cockpit_asset('/components/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.gridster/0.5.6/jquery.gridster.min.css" rel="stylesheet">
        <link href="{{ cockpit_asset('/components/chosen/chosen.min.css') }}" rel="stylesheet">
        <link href="{{ cockpit_asset('/css/app.css') }}" rel='stylesheet' type="text/css" >
        <!-- CSS -->
    </head>
    <body class="sidebar-pinned">

        <!-- Content -->
        <div id="page-container">
            <mezzo-sidebar></mezzo-sidebar>
            <div id="view-main">
                <mezzo-topbar></mezzo-topbar>
                @yield('content')
            </div>
        </div>
        <!-- Content -->

        <!-- JavaScript -->
        <script src="{{ cockpit_asset('/components/jquery/dist/jquery.min.js')}} "></script>
        <script src="{{ cockpit_asset('/components/jquery-ui/jquery-ui.min.js')}} "></script>
        <script src="{{ cockpit_asset('/components/bootstrap-sass/assets/javascripts/bootstrap.js')}} "></script>
        <script src="{{ cockpit_asset('/components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js')}} "></script>
        <script src="{{ cockpit_asset('/components/select2/dist/js/select2.js')}} "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.gridster/0.5.6/jquery.gridster.min.js"></script>
        <script src="{{ cockpit_asset('/components/angular/angular.min.js')}} "></script>
        <script src="{{ cockpit_asset('/components/angular-ui-router/release/angular-ui-router.min.js')}} "></script>
        <script src="{{ cockpit_asset('/components/angular-sortable-view/src/angular-sortable-view.min.js')}} "></script>
        <script src="{{ cockpit_asset('/components/ng-file-upload/ng-file-upload.min.js')}} "></script>
        <script src="{{ cockpit_asset('/components/chosen/chosen.jquery.min.js')}} "></script>
        <script src="{{ cockpit_asset('/components/pluralize/pluralize.js')}} "></script>
        <script src="{{ cockpit_asset('/components/sweetalert2/dist/sweetalert2.min.js')}} "></script>
        <script src="{{ cockpit_asset('/js/templates.js')}} "></script>
        <script src="{{ cockpit_asset('/js/app.js')}} "></script>
        <!-- JavaScript -->

    </body>
</html>