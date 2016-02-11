@extends('magazine.layout')

@section('content')

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{ $product->title }}

                        <a href="{{ route('shop.products.show', $product->id) }}">Show</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



    {!! $products->render() !!}

@endsection