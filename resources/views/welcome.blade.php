@extends('layouts.main')

@section('content')

    <div class="banner header-text">
        <div class="owl-banner owl-carousel">
            <div class="banner-item-01">
                <div class="text-content">
                    <h4>Best Offer</h4>
                    <h2>New Arrivals On Sale</h2>
                </div>
            </div>
            <div class="banner-item-02">
                <div class="text-content">
                    <h4>Flash Deals</h4>
                    <h2>Get your best products</h2>
                </div>
            </div>
            <div class="banner-item-03">
                <div class="text-content">
                    <h4>Last Minute</h4>
                    <h2>Grab last minute deals</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Latest Products</h2>
                        <a href="#">view all products <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>

                @forelse($products as $product)
                <div class="col-md-4">
                    <div class="product-item">
                        <a href="#"><img src="{{ asset('product_images/' . $product->image) }}" alt="{{ $product->name }}"></a>
                        <div class="down-content">
                            <a href="#"><h4>{{ $product->name }}</h4></a>
                            <h6>${{ number_format($product->price, 2) }}</h6>
                            <p>{{ $product->desc }}</p>

                            @auth
                                <div class="d-flex justify-content-between mt-4">
                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary">♡ Wishlist</button>
                                    </form>

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" style="background-color: #f33f3f; border: none;">Add to Cart</button>
                                    </form>
                                </div>
                            @endauth

                            @guest
                                <p class="pt-4"><a href="{{ route('login') }}">Log in</a> to add to cart or wishlist</p>
                            @endguest
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-md-12">
                        <p class="text-center">No products available at the moment.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination Links --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

@endsection