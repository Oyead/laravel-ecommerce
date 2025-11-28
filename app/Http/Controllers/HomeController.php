<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Shows products on the public homepage.
     */
    public function index()
    {
        $products = Product::latest()->paginate(9); 
        return view('welcome', compact('products'));
    }

    /**
     * Redirects users after login based on their role.
     */
    public function home()
    {
        // CORRECTED: This now checks for 'role'
        if (Auth::check() && Auth::user()->role == 1) {
            return view('admin.dashboard');
        } else {
            $products = Product::latest()->paginate(9);
            return view('dashboard', compact('products'));
        }
    }
}