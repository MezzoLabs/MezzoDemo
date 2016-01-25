@extends('magazine.layout')

@section('content')
    Address {{ $user->email }}

    @if($user->address)
        {!! Form::model($user->address, ['url' => 'profile/address', 'method' => 'PUT']) !!}

    @else
        {!! Form::create(\App\Address::class, ['url' => 'profile/address']) !!}
    @endif


    <label>Addressant</label>
    {!! Form::attribute('addressee') !!}

    <label>Organisation</label>
    {!! Form::attribute('organization') !!}

    <label>Straße</label>
    {!! Form::attribute('street') !!}

    <label>Straßennummer</label>
    {!! Form::attribute('street_extra') !!}

    <label>PLZ</label>
    {!! Form::attribute('zip') !!}

    <label>Stadt</label>
    {!! Form::attribute('city') !!}

    <label>Telefon</label>
    {!! Form::attribute('phone') !!}

    <label>Fax</label>
    {!! Form::attribute('fax') !!}
    {!! Form::attribute('longitude', ['wrap' => false, 'attributes' => ['type' => 'hidden']]) !!}
    {!! Form::attribute('latitude', ['wrap' => false, 'attributes' => ['type' => 'hidden']]) !!}


    <label>Land</label>
    {!! Form::attribute('country') !!}


    <input class="btn btn-primary" type="submit" value="Submit"/>
    {!! Form::close() !!}
@endsection