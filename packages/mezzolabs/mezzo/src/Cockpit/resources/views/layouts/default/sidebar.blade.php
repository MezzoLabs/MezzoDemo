<nav id="sidebar">
    <div class="sidebar-inner">
        <div id="sidebar-scroll">
            <div class="sidebar-content">
                <div class="sidebar-header clearfix">
                    <div class="pull-left sidebar-logo-wrap"><img src="/mezzolabs/mezzo/cockpit/img/mezzo/logo_sidebar.png" /></div>
                    <div class="pull-left sidebar-logotext-wrap"><b>Mezzo</b></div>
                    <div class="sidebar-pin-wrap"><i class="sidebar-pin fa fa-dot-circle-o"></i></div>
                </div>
                <div class="sidebar-content sidebar-padding">
                    @foreach(mezzo()->moduleCenter()->groups() as $group )
                    <h3>{{ $group->label() }}</h3>
                    <ul class="nav-main">

                        @foreach($group->modules() as $module )

                            <li class="{{ cockpit_html()->css('sidebar', $module) }}">
                                <a href="mezzo/{{ $module->uri() }}">
                                    <i class="{{ $module->options('icon') }}"></i>
                                    <span>{{ $module->title() }}</span>
                                    <span class="dropdown"></span>

                                </a>
                                <ul>
                                    @foreach($module->pages()->filterVisibleInNavigation() as $page)
                                        <li>
                                            <a href="mezzo/{{ $page->uri() }}" mezzo-register-state data-uri="{{ $page->uri() }}" data-title="{{ $page->title() }}">
                                                <span>{{ $page->title() }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                        @endforeach

                    @endforeach


                </div>
            </div>
        </div>
    </div>
</nav>