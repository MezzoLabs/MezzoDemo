@extends('magazine.layout')

@section('content')
    <form method="POST" action="/auth/register">
        {!! csrf_field() !!}

        <div>
            Gender
            <select name="gender">
                <option value="h">Herr</option>
                <option value="f">Frau</option>
            </select>
        </div>

        <div>
            First Name
            <input type="text" name="first_name" value="{{ old('first_name') }}">
        </div>

        <div>
            Last Name
            <input type="text" name="last_name" value="{{ old('last_name') }}">
        </div>

        <div>
            Email
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            Password
            <input type="password" name="password">
        </div>

        <div>
            Confirm Password
            <input type="password" name="password_confirmation">
        </div>

        <div>
            <button type="submit">Register</button>
        </div>
    </form>
@endsection