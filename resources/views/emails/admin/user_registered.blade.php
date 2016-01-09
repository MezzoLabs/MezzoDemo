@extends('emails.template')

@section('content')
    <p>
        A new user registered.
    </p>
    <ul>
        <li>{{ $user->name }}</li>
        <li>{{ $user->email }}</li>
        <li>{{ $user->created_at }}</li>
    </ul>
@endsection