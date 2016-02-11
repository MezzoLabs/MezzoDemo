@extends('magazine.layout')

@section('content')

    <h1>{{ $product->title }}</h1>


    <form action="{{ route('shop.add_to_basket', $product->id) }}" method="POST">
        {!! csrf_field() !!}
        {!! Form::select('amount', [1 => "1",2=> "2",3 => "3",4=> "4",5=> "5",6 => "6",7 => "7", 8=> "8",9 => "9",10 => "10"], 1) !!}
        <input type="submit" class="btn btn primary" value="To basket"/>
    </form>

    <a hreF="{{ route('shop.products.index') }}">< Products</a>


@endsection