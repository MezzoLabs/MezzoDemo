<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">


                <li class="active"><a href="/">Home</a></li>
                <li class=""><a href="/events">Events</a></li>
                <li class=""><a href="/posts">Posts</a></li>
                @if(!Auth::check())

                    <li class=""><a href="/auth/register">Register</a></li>
                    <li class=""><a href="/auth/login">Login</a></li>
                    <li class=""><a href="/password/email">Forgot Password</a></li>
                @else
                    @if(Auth::user()->canSeeCockpit())
                        <li class=""><a href="/mezzo">Cockpit</a></li>
                    @endif
                    <li class=""><a href="/profile">Hello {{ Auth::user()->name }}</a></li>
                    <li class=""><a href="/auth/logout">Logout</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>