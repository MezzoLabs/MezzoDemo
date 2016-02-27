@extends('magazine.layout')

@section('content')
    <form method="POST" action="">
        {!! csrf_field() !!}

        <div>
            Email
            <input name="email" value="{{ old('email') }}">
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
@endsection