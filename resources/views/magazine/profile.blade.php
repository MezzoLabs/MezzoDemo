@extends('magazine.layout')

@section('content')
    <h3>Hello {{ Auth::user()->email }}</h3>
@endsection