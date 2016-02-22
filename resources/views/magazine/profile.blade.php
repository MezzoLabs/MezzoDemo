@extends('magazine.layout')

@section('content')

    <h3>Hello {{ Auth::user()->email }}</h3>

    <ul>
        <li><a href="{{ route('profile.liked-categories') }}">Liked Categories</a></li>
        <li><a href="{{ route('profile.address') }}">Address</a></li>
        <li><a href="{{ route('profile.subscription') }}">Subscription</a></li>
    </ul>


    {!! Form::model($user, ['method' => 'PUT', 'route' => 'profile.update-password']) !!}

    <div class="form-group">
        <label>Password</label>
        <input type="password" value="" class="form-control"
               {!! Form::validationAttributes('password') !!} name="password"/>
    </div>
    <div class="form-group">
        <label>Password repeat</label>
        <input type="password" class="form-control"
               {!! Form::validationAttributes('password') !!} name="password_confirmation"/>
    </div>

    <input class="btn btn-primary" type="submit"/>

    {!! Form::close() !!}
@endsection