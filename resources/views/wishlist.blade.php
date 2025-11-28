@extends('layouts.main')

@section('content')

    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>Your Favorites</h4>
                        <h2>My Wishlist</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('info'))
                        <div class="alert alert-info">{{ session('info') }}</div>
                    @endif
                </div>

                @forelse($wishlistItems as $item)
                <div class="col-md-4">
                    <div class="product-item">
                        <a href="#"><img src="{{ asset('product_images/' . $item->product->image) }}" alt="{{ $item->product->name }}"></a>
                        <div class="down-content">
                            <a href="#"><h4>{{ $item->product->name }}</h4></a>
                            <h6>${{ number_format($item->product->price, 2) }}</h6>
                            <p>{{ $item->product->desc }}</p>
                            
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>

                                <form action="{{ route('cart.add', $item->product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="background-color: #f33f3f; border: none;">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-md-12">
                        <p class="text-center" style="padding: 100px 0;">Your wishlist is empty.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection