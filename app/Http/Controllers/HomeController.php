<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::latest()->take(6)->get();
        return view('home', compact('products')); 
    }

    public function products()
    {
        $products = Product::paginate(9);
        return view('user.products', compact('products'));
    }

    public function showProduct(Product $product) 
    {
        return view('user.product_detail', compact('product'));
    }
}
