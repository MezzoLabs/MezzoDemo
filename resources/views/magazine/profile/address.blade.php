@extends('magazine.layout')

@section('content')
    Address {{ $user->email }}

    {!! Form::open(array('model' => \App\Address::first(), 'url' => 'profile/address')) !!}
    {!! csrf_field() !!}

    {!! Form::attribute('addressee') !!}
    {!! Form::attribute('street') !!}
    {!! Form::attribute('organization') !!}
    {!! Form::attribute('street') !!}
    {!! Form::attribute('street_extra') !!}
    {!! Form::attribute('zip') !!}
    {!! Form::attribute('city') !!}
    {!! Form::attribute('phone') !!}
    {!! Form::attribute('fax') !!}
    {!! Form::attribute('latitude', ['wrap' => false, 'attributes' => ['type' => 'hidden']]) !!}
    {!! Form::attribute('longitude') !!}
    {!! Form::attribute('country') !!}


    <input class="btn btn-primary" type="submit" value="Submit"/>
    </form>
@endsection