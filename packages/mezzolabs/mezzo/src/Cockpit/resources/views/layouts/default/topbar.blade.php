<header id="topbar">
    <ul class="toolbox toolbox-left">
        {{-- <li>
             <i class="fa fa-bars"></i>
         </li>--}}
        <li>
            <i class="fa fa-search"></i>
        </li>
        <li>
            <a data-mezzo-href-reload="1" href="/"><i class="fa fa-globe"></i></a>
        </li>
    </ul>
    <ul class="toolbox toolbox-right">
        {{--<li>
            <i class="fa fa-bookmark-o"></i>
        </li>--}}
        {{-- <li>
            <i class="fa fa-bolt"></i>
        </li>--}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                        class="fa fa-user"></i></a>
            <ul class="dropdown-menu">
                <li><a data-mezzo-href-reload="1" href="{{ route('cockpit::logout') }}">Profile</a></li>
                <li><a data-mezzo-href-reload="1" href="{{ route('cockpit::logout') }}">Logout</a></li>
            </ul>
        </li>
    </ul>
</header>