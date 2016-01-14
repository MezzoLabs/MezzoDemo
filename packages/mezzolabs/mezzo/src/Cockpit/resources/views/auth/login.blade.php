@extends('cockpit::layouts.auth')

@section('body-class')
as
@endsection

@section('content')

    <form method="POST" action="{{ route('cockpit::login') }}">
        {!! csrf_field() !!}

        <div class="text-center">
            <img  src="{{ cockpit_asset('/img/mezzo/logo_web.png') }}" />
        </div>
        <br/>

        <div>
            <label>Email</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            <label>Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>

        <div>
            <input type="checkbox" name="remember"> Remember Me
        </div>

        <div>
            <button class="btn btn-block btn-primary" type="submit">Login</button>
        </div>
    </form>
    {{--
    <ul>
        <li><a href="{{ route('cockpit::register') }}">Register</a></li>
        <li><a href="{{ route('cockpit::password.email') }}">Forgot password</a></li>
    </ul>
    --}}
@endsection