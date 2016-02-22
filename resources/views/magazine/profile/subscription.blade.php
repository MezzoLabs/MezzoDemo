@extends('magazine.layout')

@section('content')
    <form method="POST" action="{{ route('profile.subscription.add_voucher') }}">
        {!! csrf_field() !!}
        <div class="form-group">
            <input type="text" name="code" value="{{ old('code') }}" class="form-control">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit">
        </div>
    </form>
@endsection