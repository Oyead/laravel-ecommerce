@extends('user.layout')

@section('content')
    {{-- Hero Section for the Homepage --}}
    <div class="p-5 mb-4 bg-light rounded-3 text-center">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">New Arrivals On Sale</h1>
            <p class="fs-4">Check out all of our latest and greatest products, available now.</p>
            <a href="{{ route('user.products') }}" class="btn btn-primary btn-lg">View All Products</a>
        </div>
    </div>

    {{-- Latest Products Section --}}
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h2>Latest Products</h2>
        </div>
    </div>

    <div class="row">
        {{-- This checks if the $products variable is empty --}}
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text flex-grow-1">{{ Str::limit($product->desc, 80) }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">${{ number_format($product->price, 2) }}</h6>
                        <a href="{{ route('user.products.show', $product->id) }}" class="btn btn-primary mt-auto">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            {{-- This message shows if there are no products in the database --}}
            <div class="col-12">
                <p class="text-center text-muted">No products are available at the moment. Please check back later!</p>
            </div>
        @endforelse
    </div>
@endsection