@extends('cockpit::layouts.auth')

@section('content')
<form method="POST" action="{{ route('cockpit::password.email') }}">
    {!! csrf_field() !!}

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <button class="btn btn-primary btn-block" type="submit">
            Send Password Reset Link
        </button>
    </div>
</form>
@endsection