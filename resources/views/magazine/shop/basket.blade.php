@extends('magazine.layout')

@section('content')

    @foreach($basket->products as $product)
        <div class="row">


            <div class="col-md-6">
                <a href="{{ route('shop.products.show', $product->id) }}" target="_blank">{{ $product->title }}</a>
            </div>
            <div class="col-md-3">
                <form action="{{ route('shop.set_product_amount', $product->id) }}">
                    <div class="input-group">
                        {!! Form::input('number', 'amount', $product->getPivotAmount(), ['class' => 'form-control']) !!}
                        <div class="input-group-btn">
                            <button class="btn btn-default " type="submit">&nbsp;<span
                                        class="glyphicon glyphicon-refresh" aria-hidden="true"></span>&nbsp;</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3 text-right">
                {{ $product->calculatePivotPrice() }} €
            </div>

        </div>

        <hr/>
    @endforeach

    <div class="row">
        <div class="col-md-offset-9 col-md-3 text-right">
            {{ $basket->itemsPrice() }} €
        </div>
    </div>
    <div class="row">


        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('shop.checkout') }}">Checkout</a>
        </div>
    </div>


@endsection