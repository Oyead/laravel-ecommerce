<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('wishlist', compact('wishlistItems'));
    }

    public function add(Product $product)
    {
        // Check if the product is already in the wishlist
        $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'Product is already in your wishlist!');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    public function remove(Wishlist $wishlist)
    {
        // Make sure the logged-in user owns the wishlist item
        if ($wishlist->user_id !== Auth::id()) {
            abort(403);
        }

        $wishlist->delete();
        return redirect()->back()->with('success', 'Product removed from wishlist.');
    }
}