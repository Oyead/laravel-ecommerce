@extends('user.layout')

@section('content')
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1>Latest Products</h1>
            <p>Check out all of our latest products.</p>
        </div>
    </div>

    <div class="row">
        @if($products->isEmpty())
            <div class="col-12">
                <p class="text-center">No products found.</p>
            </div>
        @else
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        {{-- Assuming 'image' column in your products table stores the path --}}
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <h6 class="card-subtitle mb-2 text-muted">${{ number_format($product->price, 2) }}</h6>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection