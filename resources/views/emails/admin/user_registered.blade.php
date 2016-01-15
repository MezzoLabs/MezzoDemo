@extends('emails.template')

@section('content')
    <p>
        A new user registered.
    </p>
    <ul>
        <li>{{ $user->gender }}</li>
        <li>{{ $user->first_name }}</li>
        <li>{{ $user->last_name }}</li>
        <li>{{ $user->email }}</li>
        <li>{{ $user->created_at }}</li>
    </ul>
@endsection