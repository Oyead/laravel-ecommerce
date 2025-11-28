<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //

    //index
    public function index(){
        $products = Product::all();
        return view('admin.products.index')->with('products' ,$products);
    }

    // create

    public function create(){
        return view('admin.products.create');
    }

    //store

public function store(Request $request){
    //valid
    $data = $request->validate([
        "name" => 'required|string|max:255',
        "desc" => 'required',
        "price" => 'required|numeric',
        "quantity" => 'required|numeric',
        "image" => 'required|image|mimes:png,jpg,jpeg',

    ]);


    //image
    $data['image'] = Storage::putFile("products",$request->image);


    // create
    $product = Product::create($data);
    //redirect
    return redirect()->route('products.index')->with('success','تم انشاء منتج بنجاح ');
}
    //edit

    //update

    //delete
    public function destroy(Request $request , $id){
        $product = Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();
    return redirect()->route('products.index')->with('success','تم سمح المنتج بنجاح ');

    }
}
