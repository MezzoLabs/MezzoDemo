@extends('emails.template')

@section('content')
    <h2>You account for the magazine was successfully verified!</h2>

    <div>
        You can now login with your credentials.
        <a href="{{ URL::to('auth/login/' . $confirmation_code) }}">{{ URL::to('auth/login/' . $confirmation_code) }}</a>.
    </div>
@endsection