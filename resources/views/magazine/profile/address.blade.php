@extends('magazine.layout')

@section('content')
    Address {{ $user->email }}

    @if($user->address)
        {!! Form::model($user->address, ['url' => 'profile/address']) !!}
    @else
        {!! Form::create(\App\Address::class, ['url' => 'profile/address']) !!}
    @endif

    {!! csrf_field() !!}

    @foreach($address->attributes as $attribute)
        {!! $attribute->render() !!}
    @endforeach

    {!! Form::attribute('addressee') !!}
    {!! Form::attribute('organization') !!}
    {!! Form::attribute('street') !!}
    {!! Form::attribute('street_extra') !!}
    {!! Form::attribute('zip') !!}
    {!! Form::attribute('city') !!}
    {!! Form::attribute('phone') !!}
    {!! Form::attribute('fax') !!}
    {{-- Form::attribute('latitude', ['wrap' => false, 'attributes' => ['type' => 'hidden']]) --}}
    {!! Form::attribute('latitude') !!}
    {!! Form::attribute('longitude') !!}
    {!! Form::attribute('country') !!}


    <input class="btn btn-primary" type="submit" value="Submit"/>
    {!! Form::close() !!}
@endsection