@extends('layouts.main')

@section('content')

    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>Your Items</h4>
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Cart Logic --}}
                    @if($cartItems->isEmpty())
                        <div class="text-center" style="padding: 100px 0;">
                            <h4>Your cart is currently empty.</h4>
                        </div>
                    @else
                        {{-- Cart Table --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th style="width: 160px;">Quantity</th>
                                    <th>Subtotal</th>
                                    <th style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>${{ number_format($item->product->price, 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="form-inline">
                                                @csrf
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 70px; text-align: center;">
                                                <button type="submit" class="btn btn-sm btn-primary ml-2">Update</button>
                                            </form>
                                        </td>
                                        <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Totals and Checkout Button --}}
                        <div class="text-right" style="margin-top: 30px;">
                            <h3 style="font-size: 24px; font-weight: 700;">Grand Total: ${{ number_format($total, 2) }}</h3>
                            <a href="#" class="btn btn-success mt-3" style="background-color: #f33f3f; border: none; padding: 12px 30px;">Proceed to Checkout</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection