@extends('cockpit::layouts.default')

@section('content-aside')
    <div ui-view="aside"></div>
@endsection

@section('content')
    <div ui-view="main"></div>
@endsection
