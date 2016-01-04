@extends('emails.template')

@section('content')
Click here to reset your password:
<a href="{{ url('password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a>
@endsection