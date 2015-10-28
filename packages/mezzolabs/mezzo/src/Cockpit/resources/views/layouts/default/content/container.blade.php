<main id="content-container">

    <div id="content-aside" ng-if="aside()" ng-cloak>
        @yield('content-aside')
    </div>
    <div id="content-main">
        <div class="content">
            @yield('content')
        </div>
        @include('cockpit::layouts.default.content.footer')
    </div>
</main>
@include('cockpit::layouts.default.quickview')