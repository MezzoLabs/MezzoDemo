<!doctype html>
<html ng-app="Mezzo">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mezzo</title>
    <base href="/">


    <!-- CSS -->
</head>
<body class="sidebar-pinned">

@include('cockpit::layouts.auth.errors')

<!-- Content -->
<div id="page-container">
    @yield('content')
</div>
<!-- Content -->

<!-- JavaScript -->
</body>
</html>