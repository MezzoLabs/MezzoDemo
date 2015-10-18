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
        <link href="/bower/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
        <link href="/bower/sweetalert2/dist/sweetalert2.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.gridster/0.5.6/jquery.gridster.min.css" rel="stylesheet">
        <link href="/bower/chosen/chosen.min.css" rel="stylesheet">
        <link href="/css/app.css" rel='stylesheet' type="text/css" >
        <!-- CSS -->
    </head>
    <body class="sidebar-pinned">

        <!-- Content -->
        <div id="page-container">
            <mezzo-sidebar></mezzo-sidebar>
            <div id="view-main">
                <mezzo-topbar></mezzo-topbar>
                <mezzo-content></mezzo-content>
                <mezzo-quickview></mezzo-quickview>
            </div>
        </div>
        <!-- Content -->

        <!-- JavaScript -->
        <script src="/bower/jquery/dist/jquery.min.js"></script>
        <script src="/bower/jquery-ui/jquery-ui.min.js"></script>
        <script src="/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
        <script src="/bower/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="/bower/select2/dist/js/select2.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.gridster/0.5.6/jquery.gridster.min.js"></script>
        <script src="/bower/angular/angular.min.js"></script>
        <script src="/bower/angular-ui-router/release/angular-ui-router.min.js"></script>
        <script src="/bower/angular-sortable-view/src/angular-sortable-view.min.js"></script>
        <script src="/bower/ng-file-upload/ng-file-upload.min.js"></script>
        <script src="/bower/chosen/chosen.jquery.min.js"></script>
        <script src="/bower/pluralize/pluralize.js"></script>
        <script src="/bower/sweetalert2/dist/sweetalert2.min.js"></script>
        <script src="/js/templates.js"></script>
        <script src="/js/app.js"></script>
        <!-- JavaScript -->

    </body>
</html>